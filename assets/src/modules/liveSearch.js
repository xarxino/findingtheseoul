const searchInput = document.querySelector(".live-search-input");
const searchResults = document.querySelector(".live-search-results");

searchInput.addEventListener("input", handleInput);

function handleInput() {
  const query = encodeURIComponent(searchInput.value.trim());
  searchResults.classList.toggle("flex", Boolean(query));
  searchResults.classList.toggle("hidden", !query);
  if (query) {
    updateSearchResults(query).catch((error) => {
      console.error("Error fetching search results:", error);
      searchResults.innerHTML =
        "<p class='text-center'>Error retrieving search results</p>";
    });
  }
}

function createColumn(title, items, query, isPost = false, archiveLink = "") {
  const regex = new RegExp(`(${query})`, "ig");
  const filteredItems = items
    .filter((item) => {
      const itemName = isPost ? item.title : item.name;
      return itemName && itemName.match(regex);
    })
    .slice(0, 5);

  const createListItem = (item) => {
    const itemName = isPost ? item.title : item.name;
    return `<li class="border-b last-of-type:border-none border-zinc-200 py-2"><a class="hover:underline" href="${
      item.url || item.permalink
    }">${itemName.replace(regex, "<strong>$1</strong>")}</a></li>`;
  };

  const listItems = filteredItems.length
    ? filteredItems.map(createListItem).join("")
    : "<li>No results found</li>";

  const moreButton =
    filteredItems.length > 5
      ? `<a href="${archiveLink}" class="mt-2 inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">More ${title}</a>`
      : "";

  return `
    <div class="flex flex-col gap-4">
      <h2 class="text-lg font-bold">${title}</h2>
      <ul class="flex flex-col gap-2">${listItems}</ul>
      ${moreButton}
    </div>`;
}

async function updateSearchResults(query) {
  if (!query) return;

  searchResults.innerHTML = `
    <div class="loading-animation flex justify-center items-center">
      <svg class="animate-spin h-5 w-5 text-zinc-500" viewBox="0 0 24 24">
        <path d="M12 2a9 9 0 00-9 9 1 1 0 002 0 7 7 0 0114 0 1 1 0 102 0 9 9 0 00-9-9z" fill="currentColor" />
      </svg>
    </div>
  `;

  try {
    const response = await fetch(
      `${livesearch_ajax_object.ajax_url}?action=livesearch&query=${query}`
    );

    if (!response.ok) {
      throw new Error(`Error ${response.status}: ${response.statusText}`);
    }

    const data = await response.json();

    if (!data || !data.success) {
      throw new Error("Error retrieving search results");
    }

    const columns = [
      {
        title: "Posts",
        items: data.data.posts,
        isPost: true,
        archiveLink: livesearch_ajax_object.post_archive_link,
      },
      {
        title: "Categories",
        items: data.data.categories,
        isPost: false,
        archiveLink: livesearch_ajax_object.categories_archive_link,
      },
      {
        title: "Tags",
        items: data.data.tags,
        isPost: false,
        archiveLink: livesearch_ajax_object.tags_archive_link,
      },
      {
        title: "Pages",
        items: data.data.pages,
        isPost: true,
        archiveLink: livesearch_ajax_object.pages_archive_link,
      },
    ];

    const html = columns
      .map((column) =>
        createColumn(
          column.title,
          column.items,
          query,
          column.isPost,
          column.archiveLink
        )
      )
      .join("");

    searchResults.innerHTML = `<div class="flex flex-col gap-4">${html}</div>`;
  } catch (error) {
    searchResults.innerHTML =
      "<p class='text-center'>Error retrieving search results</p>";
    console.error("Error fetching search results:", error);
  }
}

// Event listeners
document.addEventListener("click", hideSearchResults);
document.addEventListener("scroll", hideSearchResults);
searchInput.addEventListener("keydown", handleSearchInput);
searchInput.addEventListener("click", showSearchResults);

// Functions
function handleSearchInput(event) {
  if (event.key === "Enter") {
    const query = encodeURIComponent(searchInput.value.trim());
    event.preventDefault(); // prevent form submission and page reload
    window.location.href = "<?php echo home_url('/'); ?>?s=" + query;
    searchInput.value = "";
    hideSearchResults();
  } else if (event.key === "Escape") {
    hideSearchResults();
  }
}

function showSearchResults() {
  if (searchInput.value.trim() !== "") {
    searchResults.classList.remove("hidden");
    searchResults.classList.add("flex");
  }
}

function hideSearchResults(event) {
  if (!searchResults.contains(event.target) && event.target !== searchInput) {
    searchResults.classList.add("hidden");
    searchResults.classList.remove("flex");
  }
}

handleSearchInput();
showSearchResults();
handleEnterKey();
handleEscapeKey();
handleClickOutside();
handleScroll();

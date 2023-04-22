const searchInput = document.querySelector(".live-search-input");
let searchResults = document.querySelector(".live-search-results");

if (searchResults) {
  searchInput.addEventListener("input", () => {
    const query = encodeURIComponent(searchInput.value.trim());

    if (query) {
      searchResults.classList.remove("hidden");
      searchResults.classList.add("flex");
      updateSearchResults(query);
    } else {
      searchResults.innerHTML = "";
      searchResults.classList.add("hidden");
      searchResults.classList.remove("flex");
    }
  });
}

function createColumn(title, items, query, isPost = false, archiveLink = "") {
  const regex = new RegExp(`(${query})`, "ig");
  const filteredItems = items.filter((item) =>
    (isPost ? item.title : item.name).match(regex)
  );
  const slicedItems = filteredItems.slice(0, 5);
  const listItems = slicedItems.length
    ? slicedItems
        .map((item) => {
          const itemName = isPost ? item.title : item.name;
          const name = itemName.replace(regex, "<strong>$1</strong>");
          return `<li class="border-b last-of-type:border-none border-gray-200 py-2"><a class="hover:underline" href="${
            item.url || item.permalink
          }">${name}</a></li>`;
        })
        .join("")
    : "";

  const noResultsMessage = "<li>No results found</li>";
  const moreButton =
    filteredItems.length > 5
      ? `<a href="${archiveLink}" class="mt-2 inline-block px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">More ${title}</a>`
      : "";

  return `
    <div class="flex flex-col gap-4">
      <h2 class="text-lg font-bold">${title}</h2>
      <ul class="flex flex-col gap-2">
        ${listItems ? listItems : noResultsMessage}
      </ul>
      ${moreButton}
    </div>`;
}

function updateSearchResults(query) {
  if (!query) {
    searchResults.innerHTML = "";
    searchResults.classList.add("hidden");
    searchResults.classList.remove("flex");
    return;
  }

  // Display rotating icon for loading animation
  searchResults.innerHTML = `
    <div class="loading-animation flex justify-center items-center">
      <svg class="animate-spin h-5 w-5 text-gray-500" viewBox="0 0 24 24">
        <path d="M12 2a9 9 0 00-9 9 1 1 0 002 0 7 7 0 0114 0 1 1 0 102 0 9 9 0 00-9-9z" fill="currentColor" />
      </svg>
    </div>
  `;
  fetch(`${livesearch_ajax_object.ajax_url}?action=livesearch&query=${query}`)
    .then((response) => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error(`Error ${response.status}: ${response.statusText}`);
      }
    })
    .then((data) => {
      if (data && data.success) {
        const { posts, categories, tags, pages } = data.data;

        const postsColumn = createColumn(
          "Posts",
          posts,
          query,
          true,
          livesearch_ajax_object.post_archive_link
        );
        const categoriesColumn = createColumn(
          "Categories",
          categories,
          query,
          false,
          livesearch_ajax_object.categories_archive_link
        );
        const tagsColumn = createColumn(
          "Tags",
          tags,
          query,
          false,
          livesearch_ajax_object.tags_archive_link
        );
        const pagesColumn = createColumn(
          "Pages",
          pages,
          query,
          true,
          livesearch_ajax_object.pages_archive_link
        );

        searchResults.innerHTML = `
          <div class="flex flex-col gap-4">
            ${postsColumn}
            ${categoriesColumn}
            ${tagsColumn}
            ${pagesColumn}
          </div>`;
      } else {
        const postsColumn = createColumn("Posts", [], query, true);
        const categoriesColumn = createColumn("Categories", [], query);
        const tagsColumn = createColumn("Tags", [], query);
        const pagesColumn = createColumn("Pages", [], query, true);

        searchResults.innerHTML = `
          <div class="flex flex-col gap-4">
            ${postsColumn}
            ${categoriesColumn}
            ${tagsColumn}
            ${pagesColumn}
          </div>`;
      }
    })
    .catch((error) => {
      searchResults.innerHTML =
        "<p class='text-center'>Error retrieving search results</p>";
      console.error("Error fetching search results:", error);
    });
}

// Hide search results when clicking outside the search results container
document.addEventListener("click", (event) => {
  if (!searchResults.contains(event.target) && event.target !== searchInput) {
    searchResults.classList.add("hidden");
    searchResults.classList.remove("flex");
  }
});

// Hide search results and clear the container when clicking outside the search input and search results container
document.addEventListener("scroll", () => {
  if (!searchInput.matches(":focus")) {
    searchResults.classList.add("hidden");
    searchResults.classList.remove("flex");
  }
});

// Hide search results when scrolling, if the search input is not focused
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    searchResults.classList.add("hidden");
    searchResults.classList.remove("flex");
  }
});

// Hide search results when the ESC key is pressed
document.addEventListener("click", (event) => {
  if (
    !event.target.closest(".live-search-input") &&
    !event.target.closest(".live-search-results")
  ) {
    searchResults.classList.add("hidden");
    searchResults.classList.remove("flex");
  }
});

// Show search results when clicking the search input, if it already contains a value
searchInput.addEventListener("click", () => {
  if (searchInput.value.trim() !== "") {
    searchResults.classList.remove("hidden");
    searchResults.classList.add("flex");
  }
});

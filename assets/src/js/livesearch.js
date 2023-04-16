const searchInput = document.querySelector(".live-search-input");
const searchResults = document.querySelector(".live-search-results");
let searchTimeout;

function createColumn(title, items, query, isPost = false) {
  const regex = new RegExp(`(${query})`, "ig");
  const filteredItems = items.filter((item) =>
    (isPost ? item.title : item.name).match(regex)
  );
  const listItems = filteredItems.length
    ? filteredItems
        .map((item) => {
          const itemName = isPost ? item.title : item.name;
          const name = itemName.replace(regex, "<strong>$1</strong>");
          return `<li><a class="hover:underline" href="${
            item.url || item.permalink
          }">${name}</a></li>`;
        })
        .join("")
    : "<li>No results found</li>";

  return `
    <div class="flex flex-col gap-4">
      <h2 class="text-lg font-bold">${title}</h2>
      <ul class="flex flex-col gap-2">${listItems}</ul>
    </div>`;
}

function updateSearchResults(query) {
  if (!query || query === "") {
    searchResults.innerHTML = "";
    searchResults.classList.add("hidden");
    searchResults.classList.remove("flex");
    return;
  }

  fetch(
    `${livesearch_ajax_object.ajax_url}?action=my_live_search&query=${query}`
  )
    .then((response) => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error(`Error ${response.status}: ${response.statusText}`);
      }
    })
    .then((data) => {
      if (data && data.success) {
        const { posts, categories, tags } = data.data;
        searchResults.innerHTML = `
        ${createColumn("Posts", posts, query, true)}
        ${createColumn("Categories", categories, query)}
        ${createColumn("Tags", tags, query)}`;
      } else {
        searchResults.innerHTML = "<li>Error: Unknown error</li>";
      }
    })
    .catch((error) => {
      searchResults.innerHTML = `<li>Error: ${error.message}</li>`;
    });
}

searchInput.addEventListener("input", () => {
  clearTimeout(searchTimeout);
  const query = encodeURIComponent(searchInput.value.trim());

  if (query) {
    searchResults.classList.remove("hidden");
    searchResults.classList.add("flex");
    searchTimeout = setTimeout(() => updateSearchResults(query), 250);
  } else {
    updateSearchResults(query);
  }
});

const dropdownToggle = document.querySelector("#user-dropdown-toggle");
if (dropdownToggle) {
  const dropdownMenu = document.querySelector("#user-dropdown-menu");
  dropdownToggle.addEventListener("click", (event) => {
    event.preventDefault();
    dropdownMenu.classList.toggle("hidden");
  });
  document.addEventListener("click", (event) => {
    const isClickInside =
      dropdownToggle.contains(event.target) ||
      dropdownMenu.contains(event.target);
    if (!isClickInside) {
      dropdownMenu.classList.add("hidden");
    }
  });
  window.addEventListener("scroll", (event) => {
    dropdownMenu.classList.add("hidden");
  });
}

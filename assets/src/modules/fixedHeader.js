const headerStatic = document.querySelector("#header-static");
const headerHeight = headerStatic.offsetHeight;
const scrollThreshold = window.innerHeight * 0.4;
let lastScrollTop = 0;
let isHeaderVisible = false;
let headerFixed;

function createFixedHeader() {
  headerFixed = document.createElement("header");
  headerFixed.id = "header-fixed";
  headerFixed.innerHTML = headerStatic.innerHTML;

  // Check if user is logged into WordPress and the admin bar is visible
  const isAdminBarVisible = document.querySelector("#wpadminbar") !== null;
  if (isAdminBarVisible) {
    headerFixed.style.marginTop = "2rem";
  }

  document.body.appendChild(headerFixed);

  initMegaMenuButton(headerFixed);
}

function destroyFixedHeader() {
  headerFixed.remove();
  headerFixed = null;
}

function showFixedHeader() {
  headerFixed.classList.add("slide-down");
  headerFixed.classList.remove("slide-up");
  isHeaderVisible = true;
}

function hideFixedHeader() {
  headerFixed.classList.add("slide-up");
  headerFixed.classList.remove("slide-down");
  isHeaderVisible = false;

  // Add hidden class to menu wrapper
  const megaMenu = headerFixed.querySelector("#mega-menu");
  if (megaMenu && !megaMenu.classList.contains("hidden")) {
    megaMenu.classList.add("hidden");
  }

  // Animate the menu wrapper alongside the header
  const megaMenuWrapper = document.querySelector("#header-static #mega-menu");
  if (megaMenuWrapper) {
    megaMenuWrapper.classList.add("slide-up");
    megaMenuWrapper.classList.remove("slide-down");
  }

  // Delay removal until animation has finished
  setTimeout(function () {
    if (!isHeaderVisible && headerFixed) {
      headerFixed.remove();
      headerFixed = null;

      // Remove slide-up class from menu wrapper
      if (megaMenuWrapper) {
        megaMenuWrapper.classList.remove("slide-up");
      }
    }
  }, 1000);
}

function hideHeaderWithAnimation() {
  headerFixed.classList.add("slide-up");
  headerFixed.classList.remove("slide-down");
  isHeaderVisible = false;

  // Add hidden class to menu wrapper
  const megaMenu = headerFixed.querySelector("#mega-menu");
  if (megaMenu && !megaMenu.classList.contains("hidden")) {
    megaMenu.classList.add("hidden");
  }

  // Animate the menu wrapper alongside the header
  const megaMenuWrapper = document.querySelector("#header-static #mega-menu");
  if (megaMenuWrapper) {
    megaMenuWrapper.classList.add("slide-up");
    megaMenuWrapper.classList.remove("slide-down");
  }

  // Wait for animation to finish before removing header
  return new Promise((resolve) => {
    setTimeout(() => {
      if (!isHeaderVisible && headerFixed) {
        headerFixed.remove();
        headerFixed = null;

        // Remove slide-up class from menu wrapper
        if (megaMenuWrapper) {
          megaMenuWrapper.classList.remove("slide-up");
        }
      }
      resolve();
    }, 500); // Adjust the delay value as needed
  }).catch(() => {
    // If the animation doesn't complete, remove the header without waiting
    if (!isHeaderVisible && headerFixed) {
      headerFixed.remove();
      headerFixed = null;

      // Remove slide-up class from menu wrapper
      if (megaMenuWrapper) {
        megaMenuWrapper.classList.remove("slide-up");
      }
    }
  });
}

function handleScroll() {
  const currentScrollTop =
    window.pageYOffset || document.documentElement.scrollTop;

  if (currentScrollTop < lastScrollTop) {
    // Scrolling up
    if (!isHeaderVisible && currentScrollTop > scrollThreshold) {
      if (!headerFixed) {
        createFixedHeader();
      }
      showFixedHeader();
    }
  } else {
    // Scrolling down or reaching the threshold
    if (isHeaderVisible) {
      hideFixedHeader().then(() => {
        if (currentScrollTop <= scrollThreshold) {
          destroyFixedHeader();
        }
      });
    } else if (headerFixed && currentScrollTop <= scrollThreshold) {
      hideFixedHeader().then(() => {
        destroyFixedHeader();
      });
    }

    // Hide the menu wrapper when scrolling down
    if (!isHeaderVisible && currentScrollTop > scrollThreshold) {
      const menuWrapper = document.querySelector("#header-static #mega-menu");
      if (!menuWrapper.classList.contains("hidden")) {
        menuWrapper.classList.add("hidden");
      }
    }
  }

  if (currentScrollTop <= 0) {
    if (isHeaderVisible) {
      hideFixedHeader().then(() => {
        destroyFixedHeader();
        const menuWrapper = document.querySelector("#header-static #mega-menu");
        if (!menuWrapper.classList.contains("hidden")) {
          menuWrapper.classList.add("hidden");
        }
      });
    } else if (headerFixed) {
      destroyFixedHeader();
      const menuWrapper = document.querySelector("#header-static #mega-menu");
      if (!menuWrapper.classList.contains("hidden")) {
        menuWrapper.classList.add("hidden");
      }
    }
  }

  // Scroll the fixed header back up if the user scrolls within 40% of the top of the page
  if (headerFixed && currentScrollTop < window.innerHeight * 0.4) {
    if (isHeaderVisible) {
      hideFixedHeader().then(() => {
        if (!isHeaderVisible && headerFixed) {
          destroyFixedHeader();
        }
      });
    } else if (currentScrollTop > window.innerHeight * 0.3) {
      // Add check for 30% scroll position
      hideFixedHeader().then(() => {
        destroyFixedHeader();
      }); 
    }
  }

  lastScrollTop = currentScrollTop;
}

function initMegaMenuButton(headerElement) {
  const megaMenuButton = headerElement.querySelector("#mega-menu__button");
  const megaMenu = headerElement.querySelector("#mega-menu");

  function toggleMegaMenu() {
    megaMenu.classList.toggle("hidden");
  }

  megaMenuButton.addEventListener("click", toggleMegaMenu);
}

window.addEventListener("scroll", handleScroll);
window.addEventListener("resize", function () {
  if (headerFixed && window.scrollY < headerHeight) {
    hideFixedHeader();
    destroyFixedHeader();
  }
});

initMegaMenuButton(document.querySelector("#header-static"));

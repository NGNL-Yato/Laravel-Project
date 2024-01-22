const expand_btn = document.querySelector(".expand-btn");

let activeIndex;

expand_btn.addEventListener("click", () => {
  document.body.classList.toggle("collapsed");
});

const current = window.location.href;

const allLinks = document.querySelectorAll(".sidebar-links a");

allLinks.forEach((elem) => {
  elem.addEventListener("click", function () {
    const hrefLinkClick = elem.href;

    allLinks.forEach((link) => {
      if (link.href == hrefLinkClick) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });
  });
});

const searchInput = document.querySelector(".search__wrapper input");

searchInput.addEventListener("focus", (e) => {
  document.body.classList.remove("collapsed");
});

function adjustMainContentMargin() {
  const sidebar = document.querySelector('.sidebar');
  const mainContent = document.getElementById('mainContent');
  if (sidebar && mainContent) {
    const sidebarWidth = sidebar.offsetWidth;
    mainContent.style.marginLeft = `${sidebarWidth}px`;
  }
}

// Call this function initially and on window resize
window.onload = adjustMainContentMargin;
window.onresize = adjustMainContentMargin;

// If you have a function to toggle the sidebar, call adjustMainContentMargin inside that function

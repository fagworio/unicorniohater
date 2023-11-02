document.addEventListener("DOMContentLoaded", () => {
    stickyHeader();
    createToggleMenu("menuTitle1", "menu1", true);
    createToggleMenu("menuTitle2", "menu2", false);
  });
  
  function createToggleMenu(menuTitleId, menuId, isOpened = false) {
    const menuTitle = document.getElementById(menuTitleId);
    const menu = document.getElementById(menuId);
  
    if (isOpened) {
      menu.classList.add("show-menu");
    }
  
    menuTitle.addEventListener("click", function () {
      menu.classList.toggle("show-menu");
    });
  }
  
  function stickyHeader() {
      const header = document.querySelector("header");
      const mainNav = header.querySelector(".main-nav");
      let isSticky = false;
    
      function updateStickyState() {
        const currentScroll = window.scrollY;
    
        if (currentScroll > 0 && currentScroll > lastScroll && isSticky) {
          mainNav.classList.toggle("sticky", false);
          isSticky = false;
        } else if (currentScroll < lastScroll && !isSticky) {
          mainNav.classList.toggle("sticky", true);
          isSticky = true;
        }
    
        if (header.offsetHeight > currentScroll) {
          mainNav.classList.remove("sticky");
          isSticky = false;
        }
    
        lastScroll = currentScroll;
        requestAnimationFrame(updateStickyState);
      }
    
      let lastScroll = window.scrollY;
      requestAnimationFrame(updateStickyState);
    }
    
    
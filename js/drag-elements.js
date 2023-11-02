document.addEventListener("DOMContentLoaded", () => {
  makeElementDraggable("featured-category");
});

function makeElementDraggable(containerId) {
  const container = document.getElementById(containerId);
  let isDragging = false;
  let startPosX = 0;
  let scrollLeft = 0;
  let scrollTimeout = null;

  container.addEventListener("mousedown", (e) => {
    isDragging = true;
    startPosX = e.clientX - container.offsetLeft;
    scrollLeft = container.scrollLeft;
  });

  container.addEventListener("mouseup", (e) => {
    if (isDragging) {
      isDragging = false;
      container.style.cursor = "grab";
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(() => {
        container.classList.remove("no-click");
      }, 100);
    }
  });

  container.addEventListener("mousemove", (e) => {
    if (!isDragging) return;
    e.preventDefault();
    container.style.cursor = "grabbing";
    const x = e.clientX - container.offsetLeft;
    const walk = (x - startPosX) * 1;
    container.scrollLeft = scrollLeft - walk;
    e.preventDefault();
    e.stopPropagation();
    clearTimeout(scrollTimeout);
    container.classList.add("no-click");
  });

  container.addEventListener("click", (e) => {
    if (container.classList.contains("no-click")) {
      e.preventDefault();
      e.stopPropagation();
    }
  });
}
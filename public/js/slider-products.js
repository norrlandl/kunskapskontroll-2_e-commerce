const panels = document.querySelectorAll(".panel");
const panelOne = document.querySelector(".panel:first-child");

console.log(panelOne);

window.addEventListener("load", () => {
  panelOne.classList.add("active");
});

panels.forEach((panel) => {
  panel.addEventListener("click", () => {
    removeActiveClass();
    panel.classList.add("active");
  });
});

function removeActiveClass() {
  panels.forEach((panel) => {
    panel.classList.remove("active");
  });
}
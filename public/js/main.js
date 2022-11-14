var nav = document.querySelector("nav");

window.addEventListener("scroll", function () {
  if (window.pageYOffset > 100) {
    nav.classList.add("menu-scrolled");
    nav.classList.remove("menu");
  } else {
    nav.classList.remove("menu-scrolled");
    nav.classList.add("menu");
  }
});

const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

ScrollReveal({
  reset: true,
  distance: '40px',
  duration: 2000,
  delay: 3000
});

ScrollReveal().reveal('.anim_left', {delay: 200, origin: 'left'})
ScrollReveal().reveal('.anim_right', {delay: 200, origin: 'right'})
ScrollReveal().reveal('.anim_top', {delay: 200, origin: 'top'})
ScrollReveal().reveal('.anim_bot', {delay: 200, origin: 'bottom'})


// TOAST
window.onload = (event) => {
let myAlert = document.querySelector('.toast');
let bsAlert = new bootstrap.Toast(myAlert);
  
setTimeout(function () {
  bsAlert.show();
}, 800);
};

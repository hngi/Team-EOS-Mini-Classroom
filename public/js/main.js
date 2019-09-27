var toggleButton = document.querySelector(".toggle-button");
var mobileNav = document.querySelector(".mobile-nav");



// Look for .hamburger
var hamburger = document.querySelector(".hamburger");
// On click
toggleButton.addEventListener("click", function () {
    // Toggle class "is-active"
    // hamburger.classList.toggle("is-active");
    // Do something else, like open/close menu
    mobileNav.classList.toggle("open");

});
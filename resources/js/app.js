import "./bootstrap.js";


// Optional: Document ready
document.addEventListener("DOMContentLoaded", () => {
    console.log("Bootstrap JS loaded, DOM fully loaded.");
});

// If you have any custom JS in the future, you can add it here
// e.g., image previews, alert auto-close, or form enhancements

// Example: Auto-hide flash messages after 5 seconds
const flashMessage = document.querySelector('.alert');
if (flashMessage) {
    setTimeout(() => {
        flashMessage.classList.add('fade');
        flashMessage.addEventListener('transitionend', () => flashMessage.remove());
    }, 5000);
}

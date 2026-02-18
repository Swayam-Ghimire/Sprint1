import "./bootstrap.js";

// Example: Auto-hide flash messages after 5 seconds
const flashMessage = document.querySelector(".alert");
if (flashMessage) {
    setTimeout(() => {
        flashMessage.classList.add("fade");
        flashMessage.addEventListener("transitionend", () =>
            flashMessage.remove(),
        );
    }, 5000);
}

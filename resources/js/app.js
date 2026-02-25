import "./bootstrap.js";
import EasyMDE from "easymde";
import "easymde/dist/easymde.min.css";

document.addEventListener("DOMContentLoaded", () => {
    const textarea = document.getElementById("content");
    if (textarea) {
        window.easyMDE = new EasyMDE({
            element: textarea,
            autoDownloadFontAwesome: false, // avoid extra CSS load
            spellChecker: false,
            toolbar: [
                "bold",
                "italic",
                "heading",
                "|",
                "quote",
                "unordered-list",
                "ordered-list",
                "|",
                "link",
                "image",
                "|",
                "preview",
                "side-by-side",
                "fullscreen",
            ],
            status: false, // hide character count/status bar
        });
    }
});
// Auto-hide flash messages after 5 seconds
const flashMessage = document.querySelector(".alert");
if (flashMessage) {
    setTimeout(() => {
        flashMessage.classList.add("fade");
        flashMessage.addEventListener("transitionend", () =>
            flashMessage.remove(),
        );
    }, 5000);
}

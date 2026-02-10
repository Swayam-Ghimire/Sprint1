import "./bootstrap.js";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".custom-dropdown-toggle").forEach((toggle) => {
        toggle.addEventListener("click", (e) => {
            e.stopPropagation();

            const dropdown = toggle.closest(".custom-dropdown");

            // close other dropdowns
            document
                .querySelectorAll(".custom-dropdown.open")
                .forEach((d) => d !== dropdown && d.classList.remove("open"));

            dropdown.classList.toggle("open");
        });
    });

    // click outside closes dropdown
    document.addEventListener("click", () => {
        document
            .querySelectorAll(".custom-dropdown.open")
            .forEach((d) => d.classList.remove("open"));
    });
});

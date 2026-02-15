import "./bootstrap.js";

document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = document.querySelectorAll(".custom-dropdown");

    dropdowns.forEach((dropdown) => {
        const toggle = dropdown.querySelector(".custom-dropdown-toggle");

        toggle.addEventListener("click", (e) => {
            e.stopPropagation();

            dropdowns.forEach((d) => {
                if (d !== dropdown) d.classList.remove("open");
            });

            dropdown.classList.toggle("open");
        });
    });

    // Click outside closes dropdown
    document.addEventListener("click", () => {
        dropdowns.forEach((d) => d.classList.remove("open"));
    });

    // ESC key closes dropdown
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            dropdowns.forEach((d) => d.classList.remove("open"));
        }
    });
});


// document.addEventListener("DOMContentLoaded", () => {
//     document.querySelectorAll(".custom-dropdown-toggle").forEach((toggle) => {
//         toggle.addEventListener("click", (e) => {
//             e.stopPropagation();

//             const dropdown = toggle.closest(".custom-dropdown");

//             // close other dropdowns
//             document
//                 .querySelectorAll(".custom-dropdown.open")
//                 .forEach((d) => d !== dropdown && d.classList.remove("open"));

//             dropdown.classList.toggle("open");
//         });
//     });

//     // click outside closes dropdown
//     document.addEventListener("click", () => {
//         document
//             .querySelectorAll(".custom-dropdown.open")
//             .forEach((d) => d.classList.remove("open"));
//     });
// });

import mix from "laravel-mix";

mix.js("resources/js/app.js", "public/dist").css(
    "resources/css/app.css",
    "public/dist",
);

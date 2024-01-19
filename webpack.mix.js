let mix = require("laravel-mix");

mix
.sass("resources/css/main.scss", "public")
.js("resources/js/main.js", "public");

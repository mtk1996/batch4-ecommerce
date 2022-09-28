const mix = require("laravel-mix");
mix.js("resources/js/app.js", "public/js");
mix.js("resources/js/home.js", "public/js").react();
mix.js("resources/js/product-detail.js", "public/js").react();
mix.js("resources/js/profile.js", "public/js").react();

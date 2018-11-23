var elixir = require("laravel-elixir");

require("laravel-elixir-vue-2");

elixir(function(mix) {
    // mix.sass("app.scss").webpack("app.css");
    mix.webpack("./resources/js/app.js", "./public/js/app.js");
});

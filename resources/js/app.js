/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

const moment = require("moment");
require("moment/locale/es");

window.Vue = require("vue");

Vue.use(require("vue-moment"), {
    moment
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("dni-component", require("./components/DniComponent.vue"));
Vue.component(
    "closings-component",
    require("./components/ClosingsComponent.vue")
);
Vue.component(
    "missings-component",
    require("./components/MissingsComponent.vue")
);

const app = new Vue({
    el: "#app"
});

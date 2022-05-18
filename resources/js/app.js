
import './jquery.js'
window.Vue = require("vue");
import Routes from "./routes.js";
import storeEvent from "./storeEvent.js";


Vue.component("home", require("./components/dashboard/dashboard.vue").default);
const app = new Vue({
    el: "#contents",
    router: Routes,
    store: storeEvent,
});
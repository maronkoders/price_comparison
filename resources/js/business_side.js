window.Vue = require("vue");
import Routes from "../js/components/business/commons/routes";
import Store from "../js/components/business/commons/store";
Vue.component("home-page", require("./components/business/home.vue").default);
Vue.component("inactive-products", require("./components/business/inactiveProducts.vue").default);
Vue.component("active-products", require("./components/business/activeProducts.vue").default);
Vue.component("desktop-header", require("./components/business/desktopHeader.vue").default);
const app = new Vue({
    el: "#business_dashboard",
    router: Routes,
    store:Store
});
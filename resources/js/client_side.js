window.Vue = require("vue");
import Routes from "../js/components/commons/client-routes";
import Store from "../js/storeEvent";
Vue.component("home", require("./components/client/home.vue").default);
const app = new Vue({
    el: "#clientSide",
    router: Routes,
    store:Store
});
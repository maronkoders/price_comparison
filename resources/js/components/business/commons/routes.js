import Vue from "vue";
import VueRouter from "vue-router";
import homePage  from "@/js/components/business/home.vue";
import inactiveProducts  from "@/js/components/business/inactiveProducts.vue";
import activeProducts  from "@/js/components/business/activeProducts.vue";
import notAuthorized from "@/js/components/notAuthorized.vue";
Vue.use(VueRouter);

const router = new VueRouter({
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    mode: "history",
    routes: [
        {
            path: "/home-page",
            name: "homePage",
            component: homePage,
            props: route => ({ query: route.query.q })
        },
        {
            path: "/inactive-products",
            name: "inactiveProducts",
            component: inactiveProducts,
            props: route => ({ query: route.query.q })
        },
        {
            path: "/active-products",
            name: "activeProducts",
            component: activeProducts,
            props: route => ({ query: route.query.q })
        },
        {
            path: "/not-authorized",
            name: "notAuthorized",
            component: notAuthorized
        },
    ]
});

export default router;
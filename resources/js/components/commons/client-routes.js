import Vue from "vue";
import VueRouter from "vue-router";
import index  from "@/js/components/client/home.vue";
import setPassword  from "@/js/components/client/setPassword.vue";
import verifyEmail  from "@/js/components/client/verifyEmail.vue";
import priceCatalogList  from "@/js/components/client/priceCatalogList.vue";

import notAuthorized from "@/js/components/notAuthorized.vue";
Vue.use(VueRouter);

const router = new VueRouter({
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    mode: "history",
    routes: [
        {
            path: "/price-comparison",
            name: "priceCatalogList",
            component: priceCatalogList
        },
        {
            path: "/",
            name: "index",
            component: index
        },
        {
            path: "/set-password",
            name: "setPassword",
            component: setPassword,
            props: route => ({ query: route.query.q })
        },
        {
            path: "/verify_email",
            name: "verifyEmail",
            component: verifyEmail,
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
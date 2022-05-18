import Vue from "vue";
import VueRouter from "vue-router";
import home from "@/js/components/dashboard/dashboard.vue";
import index  from "@/js/components/client/home.vue";
import industries from "@/js/components/dashboard/industries.vue";
import companies from "@/js/components/dashboard/companies.vue";
import skus from "@/js/components/dashboard/skus.vue";
import manufacturers from "@/js/components/dashboard/manufacturers.vue";
import productCategories from "@/js/components/dashboard/categories.vue";
import catalogPromotion from "@/js/components/dashboard/catalog_promotion.vue";
import companyRedirect from "@/js/components/dashboard/company_redirect.vue";
import addNewPromotion from "@/js/components/dashboard/addNewPromotion.vue";
import headerPromotion from "@/js/components/dashboard/headerPromotion.vue";
import products from "@/js/components/dashboard/products.vue";
import user_data from "@/js/components/dashboard/user_data.vue";
import users from "@/js/components/dashboard/users.vue";
import subscribers from "@/js/components/dashboard/subscribers.vue";
// import addSubscription from "@/js/components/dashboard/addSubscription.vue";
import notAuthorized from "@/js/components/notAuthorized.vue";
import manufacturerProducts from "@/js/components/dashboard/manufacturerProducts.vue"
import storeMetrics from "@/js/components/dashboard/storeMetrics.vue"
import productsPerformance from "@/js/components/dashboard/productsPerformance.vue"
import store from  "@/js/storeEvent.js";

Vue.use(VueRouter);
const workerRoutes = 
[
    "/home",
    "/products",
    "/subscribers",
    "/product-categories",
    "/industries",
    "/companies",
    "/manufacturers",
    "/companies_redirect",
    "/skus",
    "/catalog_promotion",
    "/add_new_promotion",
    "/add_header_promotion",
    "/users",
    "/manufacturer-products",
    "/user_data",
    "/store-metrics",
];

const router = new VueRouter({
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
    mode: "history",
    routes: [{
            path: "/home",
            name: "home",
            component: home
        },
        {
            path: "/",
            name: "index",
            component: index
        },
        {
            path: "/product-categories",
            name: "productCategories",
            component: productCategories
        },
        {
            path: "/add_header_promotion",
            name: "headerPromotion",
            component: headerPromotion
        },
        {
            path: "/companies_redirect",
            name: "companyRedirect",
            component: companyRedirect
        },
        {
            path: "/catalog_promotion",
            name: "catalogPromotion",
            component: catalogPromotion
        },
        {
            path: "/store-metrics",
            name: "storeMetrics",
            component: storeMetrics
        },
        {
            path: "/add_new_promotion",
            name: "addNewPromotion",
            component: addNewPromotion
        },
        {
            path: "/subscribers",
            name: "subscribers",
            component: subscribers
        },
        // {
        //     path: "/products-performance",
        //     name: "productsPerformance",
        //     component: productsPerformance
        // },
        {
            path: "/skus",
            name: "skus",
            component: skus
        },
        {
            path: "/products",
            name: "products",
            component: products
        },
        {
            path: "/industries",
            name: "industries",
            component: industries
        },
        {
            path: "/companies",
            name: "companies",
            component: companies
        },
        {
            path: "/manufacturers",
            name: "manufacturers",
            component: manufacturers
        },
        {
            path: "/manufacturer-products",
            name: "manufacturerProducts",
            component: manufacturerProducts
        },
        {
            path: "/users",
            name: "users",
            component: users
        },
        {
            path: "/user_data",
            name: "user_data",
            component: user_data,
            props: route => ({ query: route.query.q })
        },
        {
            path: "/not-authorized",
            name: "notAuthorized",
            component: notAuthorized
        },
    ]
});

router.beforeEach((to, from, next) => {    
    if(store.state.loggedInUserType.role === "isWorker")
    {
        return (Object.values(workerRoutes).includes(to.matched[0].path))?next():router.push("/not-authorized");
    }else{
        return next();
    }
})

export default router;
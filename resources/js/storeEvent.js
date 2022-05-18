import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);
Vue.config.devtools = true

const storeEvent = new Vuex.Store({
    plugins: [createPersistedState()],
    state: {
        loggedInUserType:"",
        categories:[],
        industries:[],
        companies:[],
        defaultCompany :"",
        selectedCategorySku:"",
        selectedIndustryId:"",
        selectedCategoryIds:"",
        selectedCompanies:"",
        manufacturer:"",
        userToken:null
    },
    mutations: {
        putDefaultCompany(state, payload)
        {
            state.defaultCompany  = payload;
        },
        putCategories(state, payload)
        {
            state.categories  = payload;
        },
        putIndustries(state, payload)
        {
            state.industries  = payload;
        },
        putCompanies(state, payload)
        {
            state.companies  = payload;
        },
        putLoggedInUser(state, payload)
        {
            state.loggedInUserType =payload
        },
        putSelectedCategorySku(state , payload)
        {
            state.selectedCategorySku = payload;
        },
        putSelectedIndustryId(state, payload)
        {
            state.selectedIndustryId = payload;
        },
        putSelectedCategoryIds(state, payload)
        {
            state.selectedCategoryIds = payload;
        },
        putSelectedCompanies(state, payload)
        {
            state.selectedCompanies = payload;
        },
        putManufacturerData(state, payload)
        {
            state.manufacturer = payload;
        },
        putUserToken(state, payload)
        {
            state.userToken = payload;
        }
    }
});
export default storeEvent;
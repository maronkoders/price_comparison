import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);
Vue.config.devtools = true

const store = new Vuex.Store({
    
    plugins: [createPersistedState()],
    state: {
        userToken:'',
        companyData:'',
        userData:''
    },

    mutations: {
        putUserToken(state, payload)
        {
            state.userToken = payload
        },
        putUserData(state, payload)
        {
            state.userData = payload
        },
        putCompanyData(state, payload)
        {
            state.companyData = payload
        }
    }
});

export default store;
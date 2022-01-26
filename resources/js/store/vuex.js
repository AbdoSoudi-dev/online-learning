import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
// import * as Cookies from "js-cookie";

const store = new Vuex.Store({
    state () {
        return {
            currentUser:{},
            token:""
        }
    },
    mutations:{
        get_current_user(state,payload){
            state.currentUser = payload;
        },
        get_token(state,payload){
            state.token = payload;
        },
    },
    plugins: [createPersistedState()],

});
export default store;

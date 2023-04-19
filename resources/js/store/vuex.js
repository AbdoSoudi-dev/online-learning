import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";

const store = new Vuex.Store({
    state () {
        return {
            currentUser:{},
            token:"",
            courses: []
        }
    },
    mutations:{
        get_current_user(state,payload){
            state.currentUser = payload;
        },
        get_token(state,payload){
            state.token = payload;
        },
        get_courses(state,payload){
            state.courses = payload;
        }
    },
    plugins: [createPersistedState()],

});
export default store;

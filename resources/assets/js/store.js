import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        auth_id: '',
        admin_id: '',
        auth_mobile: '',
        admin_mobile: '',
        my_url: '',
        base_url: '',
        locale: '',
        file_default: {},
        file_form_field: {},
        file_table: {},
        my_data: {},
    },
    getters: {
        

    },
    mutations: {
        setAuth: function(state, auth_id){
            state.auth_id = auth_id;
            state.admin_id = auth_id;
        },
        setAuthMobile: function(state, auth_mobile){
            state.auth_mobile = auth_mobile;
            state.admin_mobile = auth_mobile;
        },
        setUrl: function(state, payload){
            state.my_url = payload.our_domain;
            state.base_url = payload.our_domain;
        },
        setLocale: function(state, payload){
            state.locale = payload.locale;
        },
        setDefault: function(state, payload){
            state.file_default = payload.file_default;
        },
        setFormField: function(state, payload){
            state.file_form_field = payload.file_form_field;
        },
        setTableFile: function(state, payload){
            state.file_table = payload.file_table;
        }
    }
});

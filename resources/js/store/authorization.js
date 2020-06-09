import {logout} from '../api/authorization.js';

export default {
    namespaced: true,
    state: {
        accessToken: '',
        isAdmin: false,
        isCashier: false,
        isWaitress: false,
    },
    mutations: {
        accessToken: (state, token) => {
            state.accessToken = token;
        },
        userRoles: (state, roles) => {
            state.isAdmin = !!roles.isAdmin;
            state.isCashier = !!roles.isCashier;
            state.isWaitress = !!roles.isWaitress;
        },
    },
    getters: {
        isLoggedIn: state => {
            return state.accessToken && state.accessToken.length || localStorage.getItem('token') && localStorage.getItem('token').length;
        },
        isAdmin: state => {
            return state.isAdmin;
        },
        isCashier: state => {
            return state.isAdmin;
        },
        isWaitress: state => {
            return state.isAdmin;
        },
    },
    actions: {
        setAccessToken: (state, token) => {
            localStorage.setItem('token', token);
            state.commit('accessToken', token);
        },
        setUserRoles: (state, roles) => {
            state.commit('userRoles', roles);
        },
        logout: async state => {
            await logout();

            localStorage.clear();
            state.commit('accessToken', '');
        },
    },
};

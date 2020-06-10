import {logout} from '../api/authorization.js';

export default {
    namespaced: true,
    state: {
        accessToken: '',
        isAdmin: false,
        isCashier: false,
        isWaitress: false,
        isCustomer: false,
        hasRole: false,
    },
    mutations: {
        accessToken: (state, token) => {
            state.accessToken = token;
        },
        userRoles: (state, roles) => {
            state.isAdmin = !!roles.isAdmin;
            state.isCashier = !!roles.isCashier;
            state.isWaitress = !!roles.isWaitress;
            state.isCustomer = !!roles.isCustomer;
        },
        hasRole: (state) => {
            state.hasRole = true;
        }
    },
    getters: {
        isLoggedIn: state => {
            return state.accessToken && state.accessToken.length || localStorage.getItem('token') && localStorage.getItem('token').length;
        },
        isAdmin: state => {
            return state.isAdmin;
        },
        isCashier: state => {
            return state.isCashier;
        },
        isWaitress: state => {
            return state.isWaitress;
        },
        isCustomer: state => {
            return state.isCustomer;
        },
        hasRole: state => {
            return state.isAdmin || state.isCashier || state.isWaitress || state.isCustomer || state.hasRole;
        },
    },
    actions: {
        setAccessToken: (state, token) => {
            localStorage.setItem('token', token);
            state.commit('accessToken', token);
        },
        setUserRoles: (state, roles) => {
            state.commit('userRoles', roles);
            state.commit('hasRole');
        },
        logout: async state => {
            await logout();

            localStorage.clear();
            state.commit('accessToken', '');
        },
    },
};

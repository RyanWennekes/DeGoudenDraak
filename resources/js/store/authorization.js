import {logout} from '../api/authorization.js';

export default {
    namespaced: true,
    state: {
        accessToken: '',
    },
    mutations: {
        accessToken: (state, token) => {
            state.accessToken = token;
        },
    },
    getters: {
        isLoggedIn: state => {
            return state.accessToken === 'token' || localStorage.getItem('token') === 'token';
        },
    },
    actions: {
        setAccessToken: (state, token) => {
            localStorage.setItem('token', token);
            state.state.accessToken = token;
        },
        logout: async state => {
            await logout();

            localStorage.removeItem('token');
            state.state.accessToken = '';
        },
    },
};

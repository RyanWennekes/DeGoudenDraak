export default {
    namespaced: true,
    state: {
        accessToken: '',
    },
    mutations: {
        accessToken: (state, token) => state.accessToken = token,
    },
    getters: {
        isLoggedIn: state => {
            return true;
        },
    },
    actions: {
        afterLoggingIn: state => {
            state.accessToken = 'test';
        },
    },
};

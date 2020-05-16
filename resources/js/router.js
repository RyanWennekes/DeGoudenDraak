import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

/* Container: In here we will create our beautifull Vue application */
/* Components like below can be used inside blades */
Vue.component('vue-app', require('./App.vue').default);

/* Here will all pages being placed */
import Page404 from './pages/Page404.vue';
import Home from './pages/Home.vue';
import Login from './pages/Login.vue';

import store from './store';

/* The VueRouter uses a RouterView for navigation through pages without reloading the website */
/* With the VueRouter you can create a single-load-page */
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/home',
            redirect: {name: 'home'},
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '',
            beforeEnter: store.getters['Authorization/isLoggedIn'],
            children: [
                // every route when loggedIn
            ]
        },
        {
            path: '/*',
            component: Page404,
        },
    ],
});

export {router};

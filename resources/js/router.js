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
import Test from './pages/Test.vue';
import AdminLayout from './layouts/admin.vue';

/* Admin Pages */
import OrderResource from './pages/admin/OrderResource.vue';
import ProductResource from './pages/admin/ProductResource.vue';

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
            path: '/beheer',
            meta: {loginRequired: true},
            component: AdminLayout,
            children: [
                // every route when loggedIn
                {
                    path: 'test',
                    name: 'admin.test',
                    component: Test,
                },
                {
                    path: 'producten',
                    name: 'admin.products',
                    component: ProductResource,
                },
                {
                    path: 'bestelling-aanmaken',
                    name: 'admin.create.order',
                    component: OrderResource,
                },
                {
                    path: '',
                    redirect: {name: 'admin.create.order'},
                },
            ],
        },
        {
            path: '/*',
            component: Page404,
        },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.loginRequired) && !store.getters['Authorization/isLoggedIn']) {
        next({
            name: 'login', params: {
                afterLoggedIn: to.name,
            },
        });
    } else {
        next();
    }
});

export {router};

import Vue from 'vue';

import '@babel/polyfill';
import store from './store';
import {router} from './router.js';
import {vuetify} from './plugin';

import api from './plugin/api';
import i18n from './plugin/i18n';
import Lodash from 'lodash';

Vue.use(Lodash);

Vue.config.productionTip = false;
Vue.prototype.$http = api;

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.prototype.$globalEvents = new Vue();

new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    i18n,
});

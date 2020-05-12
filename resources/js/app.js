window.Vue = require('vue');
import Vue from 'vue';

import '@babel/polyfill';
import {router} from './plugin/router.js';
import {vuetify} from './plugin';

import api from './plugin/api';
import Lodash from 'lodash';

Vue.use(Lodash);

Vue.config.productionTip = false;
Vue.prototype.$http = api;

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

new Vue({
    router,
    vuetify,
    el: '#app',
});

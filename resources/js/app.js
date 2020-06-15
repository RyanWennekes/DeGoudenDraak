window.Vue = require('vue');
import Vue from 'vue';

import '@babel/polyfill';
import store from './store';
import {router} from './router.js';
import {vuetify} from './plugin';
import VueI18n from "vue-i18n";

import api from './plugin/api';
import Lodash from 'lodash';

Vue.use(Lodash);
Vue.use(VueI18n);

Vue.config.productionTip = false;
Vue.prototype.$http = api;

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


const i18n = new VueI18n({
    locale: 'en',
    messages: {
        en: {
            subtitle: 'Chinese Indian Specialties',
            title: 'The Golden Dragon',
            navigation: {
                menu: 'Menu',
                news: 'News',
                contact: 'Contact',
            },
            menu: {
                title: 'Menu',
                sale: 'sale',
                pdf: 'Download Menu',
            },
            contact: {
                title: 'Contact',
            },
            news: {
                title: 'News',
                message: "Due to the outbreak of the COVID-19 virus, the restaurant is currently closed. Don't worry, you can still order your favourite takeout dishes! Sincerely, Golden Dragon staff."
            }
        },
        nl: {
            subtitle: 'Chinees Indische Specialiteiten',
            title: 'De Gouden Draak',
            navigation: {
                menu: 'Menu',
                news: 'Nieuws',
                contact: 'Contact',
            },
            menu: {
                title: 'Menukaart',
                sale: 'actie',
                pdf: 'Download Menukaart',
            },
            contact: {
                title: 'Contact',
            },
            news: {
                title: 'Nieuws',
                message: "Wegens de uitbraak van het COVID-19 virus is het restaurant momenteel gesloten. Niet getreurd, u kunt uw favoriete gerechten alsnog komen afhalen!"
            }
        }
    },
});

new Vue({
    router,
    vuetify,
    store,
    i18n,
    el: '#app',
});

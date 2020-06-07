import cssVars from 'css-vars-ponyfill';
import vuetify from './vuetify';
import Vue from 'vue';

cssVars();

Vue.filter('currency', function (value) {
    if (typeof value !== 'number' && Number.isNaN(parseFloat(value))) {
        return value;
    }

    let formatter = new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 2,
    });

    return formatter.format(parseFloat(value));
});

export {vuetify};

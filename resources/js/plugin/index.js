import cssVars from 'css-vars-ponyfill';
import vuetify from './vuetify';
import Vue from 'vue';

cssVars();

Vue.filter('currency', function (value) {
    if (typeof value !== 'number') {
        return value;
    }

    let formatter = new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
});

export {vuetify};

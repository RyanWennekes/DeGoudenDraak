import {get, post} from '../index.js';

function retrieveByCategory() {
    return get('productTypes');
}

function generatePDF(locale) {
    return get('pdf', {locale: locale}, 'arraybuffer');
}

function order(basket) {
    return post('order', {"basket": basket}, {});
}

export {
    retrieveByCategory,
    generatePDF,
    order
};

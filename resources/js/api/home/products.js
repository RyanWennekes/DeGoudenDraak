import {get} from '../index.js';

function retrieveByCategory() {
    return get('productTypes');
}

function generatePDF(locale) {
    return get('pdf', {locale: locale}, 'arraybuffer');
}

export {
    retrieveByCategory,
    generatePDF
};

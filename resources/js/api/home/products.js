import {get} from '../index.js';

function retrieveByCategory() {
    return get('productTypes');
}

function generatePDF() {
    return get('pdf', null, 'arraybuffer');
}

export {
    retrieveByCategory,
    generatePDF
};

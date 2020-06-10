import {get, put, post} from '../api/index.js';

function fetchAllOffers() {
    return get('offers');
}

function updateOffer(offer) {
    return put(`offers/${offer.id}`, offer);
}

function createOffer(offer) {
    return post('offers', {
        'date_end': `${offer.date_end} 00:00:00`,
        'date_start': `${offer.date_start} 23:59:59`,
        'product_id': offer.product_id,
        'discount': offer.discount,
    });
}

export {
    fetchAllOffers,
    updateOffer,
    createOffer,
};

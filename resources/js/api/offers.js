import {get, put, post, destroy} from '../api/index.js';

function fetchAllOffers() {
    return get('admin/offers');
}

function updateOffer(offer) {
    return put(`admin/offers/${offer.id}`, offer);
}

function deleteOffer(offer) {
    return destroy(`admin/offers/${offer.id}`);
}

function createOffer(offer) {
    return post('admin/offers', {
        'date_end': `${offer.date_end} 23:59:59`,
        'date_start': `${offer.date_start} 00:00:00`,
        'product_id': offer.product_id,
        'discount': offer.discount,
    });
}

export {
    fetchAllOffers,
    updateOffer,
    createOffer,
    deleteOffer,
};

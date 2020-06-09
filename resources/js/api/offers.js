import {get, put, post} from '../api/index.js';

function fetchAllOffers() {
    return get('offers');
}

function updateOffer(offer) {
    return put(`offers/${offer.id}`, offer);
}

function createOffer(offer) {
    return post('offers', offer);
}

export {
    fetchAllOffers,
    updateOffer,
    createOffer,
};

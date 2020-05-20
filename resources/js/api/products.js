import {get} from '../api/index.js';

function fetchAllProducts() {
    return get('products');
}

function fetchProduct(productId) {
    return get(`products/${productId}`);
}

export {
    fetchAllProducts,
    fetchProduct,
};

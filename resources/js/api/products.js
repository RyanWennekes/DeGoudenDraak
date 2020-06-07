import {get, put} from '../api/index.js';

function fetchAllProducts() {
    return get('products');
}

function fetchProduct(productId) {
    return get(`products/${productId}`);
}

function updateProduct(product) {
    return put(`products/${product.id}`, product);
}

export {
    fetchAllProducts,
    fetchProduct,
    updateProduct,
};

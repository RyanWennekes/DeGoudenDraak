import {get, put, post, destroy} from '../api/index.js';

function fetchAllProducts() {
    return get('products');
}

function fetchProduct(productId) {
    return get(`products/${productId}`);
}

function updateProduct(product) {
    return put(`products/${product.id}`, product);
}

function deleteProduct(product) {
    return destroy(`products/${product.id}`);
}

function createProduct(product) {
    return post('products', product);
}

export {
    fetchAllProducts,
    fetchProduct,
    updateProduct,
    createProduct,
    deleteProduct,
};

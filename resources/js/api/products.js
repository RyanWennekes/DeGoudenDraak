import {get, put, post} from '../api/index.js';

function fetchAllProducts() {
    return get('products');
}

function fetchAllProductsMinimized() {
    return get('products/minimized');
}

function fetchProduct(productId) {
    return get(`products/${productId}`);
}

function updateProduct(product) {
    return put(`products/${product.id}`, product);
}

function createProduct(product) {
    return post('products', product);
}

export {
    fetchAllProducts,
    fetchAllProductsMinimized,
    fetchProduct,
    updateProduct,
    createProduct,
};

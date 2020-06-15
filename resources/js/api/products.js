import {get, put, post, destroy} from '../api/index.js';

function fetchAllProducts() {
    return get('products');
}

function fetchAllProductsMinimized() {
    return get('products/minimized');
}

function fetchProduct(productId) {
    return get(`products/${productId}`);
}

function updateProductName(product) {
    return put(`products/${product.id}`, {
        name: product.name,
    });
}

function updateProductCode(product) {
    return put(`products/${product.id}`, {
        code: product.code,
    });
}

function deleteProduct(product) {
    return destroy(`products/${product.id}`);
}

function createProduct(product) {
    return post('products', product);
}

export {
    fetchAllProducts,
    fetchAllProductsMinimized,
    fetchProduct,
    updateProductName,
    updateProductCode,
    createProduct,
    deleteProduct,
};

import {post} from '../api/index.js';

function createOrder(order) {
    return post('admin/orders', order);
}

function createGuestOrder(order) {
    return post('storeTableOrder', order);
}

export {
    createOrder,
    createGuestOrder
};

import {get, post} from '../api/index.js';

function fetchAllOrders(orderDate) {
    return get('admin/orders', {
        date: orderDate,
    })
}

function createOrder(order) {
    return post('admin/orders', order);
}

function createGuestOrder(order) {
    return post('storeTableOrder', order);
}

export {
    fetchAllOrders,
    createOrder,
    createGuestOrder
};

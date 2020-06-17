import {get, post} from '../api/index.js';

function fetchAllOrders(orderDate) {
    return get('admin/orders', {
        date: orderDate,
    })
}

function createOrder(order) {
    return post('admin/orders', order);
}

export {
    fetchAllOrders,
    createOrder,
};

import {post} from '../api/index.js';

function createOrder(order) {
    return post('orders', order);
}

export {
    createOrder,
};

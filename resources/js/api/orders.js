import {post} from '../api/index.js';

function createOrder(order) {
    return post('admin/orders', order);
}

export {
    createOrder,
};

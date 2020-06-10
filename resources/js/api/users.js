import {get, put, post} from '../api/index.js';

function fetchAllUsers() {
    return get('users');
}

function updateUser(user) {
    return put(`users/${user.id}`, user);
}

function createUser(user) {
    return post('users', user);
}

export {
    fetchAllUsers,
    updateUser,
    createUser,
};

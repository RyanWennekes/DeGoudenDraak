import {get, put, post, destroy} from '../api/index.js';

function fetchAllUsers() {
    return get('users');
}

function updateUser(user) {
    return put(`users/${user.id}`, user);
}

function createUser(user) {
    return post('users', user);
}

function deleteUser(user) {
    return destroy(`users/${user.id}`, {user: user.id});
}

export {
    fetchAllUsers,
    updateUser,
    createUser,
    deleteUser,
};

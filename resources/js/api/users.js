import {get, put, post, destroy} from '../api/index.js';

function fetchAllUsers() {
    return get('admin/users');
}

function updateUser(user) {
    return put(`admin/users/${user.id}`, user);
}

function createUser(user) {
    return post('admin/users', user);
}

function deleteUser(user) {
    return destroy(`admin/users/${user.id}`, {user: user.id});
}

export {
    fetchAllUsers,
    updateUser,
    createUser,
    deleteUser,
};

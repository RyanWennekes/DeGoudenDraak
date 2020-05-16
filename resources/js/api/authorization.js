import {post, get} from '../api/index.js';

function login(email, password) {
    return post('login', {
        'email': email,
        'password': password,
        'remember': true,
    });
}

function logout() {
    return post('logout');
}

function user() {
    return get('user');
}

function passwordForgotten(email) {
    return post('password/forgotten', {
        email: email,
    });
}

export {
    passwordForgotten,
    login,
    logout,
    user,
};

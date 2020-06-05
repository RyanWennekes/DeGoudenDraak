import axios from 'axios';

// These're WEB-requests
function login(email, password) {
    return axios.post('login', {
        'email': email,
        'password': password,
        'remember': true,
    });
}

function logout() {
    return axios.post('logout');
}

function passwordForgotten(email) {
    return axios.post('password/forgotten', {
        email: email,
    });
}

export {
    passwordForgotten,
    login,
    logout,
};

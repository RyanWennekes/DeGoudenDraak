import axios from 'axios';

var axiosInstance = axios.create({
    baseURL: window.location.origin,
});

// These're WEB-requests
function login(email, password) {
    return axiosInstance.post('login', {
        'email': email,
        'password': password,
        'remember': true,
    });
}

function logout() {
    return axiosInstance.post('logout');
}

function fetchApiToken() {
    return axiosInstance.get('oath/token');
}

function passwordForgotten(email) {
    return axiosInstance.post('password/forgotten', {
        email: email,
    });
}

export {
    passwordForgotten,
    fetchApiToken,
    login,
    logout,
};

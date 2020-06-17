import axios from 'axios';
import {router} from '../router.js';

var axiosInstance = axios.create({
    baseURL: window.location.origin,
    validateStatus: function (status) {
        // Return to Homepage when status is 401
        if (status === 401) {
            router.push({name: 'login'});
        }

        return status >= 200 && status < 300; // default
    }
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

function fetchUserRoles() {
    return axiosInstance.get('oath/roles');
}

function passwordForgotten(email) {
    return axiosInstance.post('password/forgotten', {
        email: email,
    });
}

export {
    passwordForgotten,
    fetchApiToken,
    fetchUserRoles,
    login,
    logout,
};

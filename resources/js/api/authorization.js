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

function passwordForgotten(email) {
    return axiosInstance.post('password/forgotten', {
        email: email,
    });
}

export {
    passwordForgotten,
    login,
    logout,
};

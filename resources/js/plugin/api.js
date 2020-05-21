import axios from 'axios';
import qs from 'qs';
import * as Cookies from 'js-cookie';

/* Every Request will start with the baseUrl and has inside the header 'Accept' */
let instance = axios.create({
    baseURL: window.location.hostname,
    headers: {
        Accept: 'application/json',
    },
    validateStatus: function (status) {
        return status >= 200 && status < 300; // default
    }, paramsSerializer: function (params) {
        return qs.stringify(params, {arrayFormat: 'repeat', encode: false});
    },
});

/**
 * Request interceptor that catches the request and injects the token into the Authorization header.
 */
instance.interceptors.request.use((request) => {
    let token = Cookies.get('access_token');
    if (typeof token === 'undefined') {
        let hash = {};
        window.location.hash.substring(1).split('&').map((parameter) => hash[parameter.split('=')[0]] = parameter.split('=')[1]);
        if (typeof hash.access_token !== 'undefined') {
            Cookies.set('access_token', hash.access_token);
            token = hash.access_token;
        }
    }
    if (typeof token === 'string') {
        request.headers.Authorization = 'Bearer ' + token;
    }

    return request;
});

instance.interceptors.request.use((request) => {
    if (request.method === 'put' && request.data instanceof FormData) {
        request.method = 'post';
        request.data.append('_method', 'put');
    }

    return request;
});

export default instance;

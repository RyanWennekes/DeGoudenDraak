import axios from 'axios';
import qs from 'qs';
import {router} from '../router.js';

/* Every Request will start with the baseUrl and has inside the header 'Accept' */
let instance = axios.create({
    baseURL: `/api`,
    headers: {
        Accept: 'application/json',
    },
    validateStatus: function (status) {
        // Return to Homepage when status is 401
        if (status === 401) {
            router.push({name: 'login'});
        }

        return status >= 200 && status < 300; // default
    }, paramsSerializer: function (params) {
        return qs.stringify(params, {arrayFormat: 'repeat', encode: false});
    },
});

instance.interceptors.request.use((request) => {
    request.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    request.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    if (request.method === 'put' && request.data instanceof FormData) {
        request.method = 'post';
        request.data.append('_method', 'put');
    }

    return request;
});

export default instance;

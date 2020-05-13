import axios from 'axios';

/* Every Request will start with the baseUrl and has inside the header 'Accept' */
let instance = axios.create({
    baseURL: 'http://127.0.0.1:8000/',
    headers: {
        Accept: 'application/json',
        'Access-Control-Allow-Origin': true,
    },
});

instance.interceptors.request.use((request) => {
    if (request.method === 'put' && request.data instanceof FormData) {
        request.method = 'post';
        request.data.append('_method', 'put');
    }

    return request;
});

export default instance;

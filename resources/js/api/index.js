import api from '../plugin/api.js';

async function get(url, params = {}, responseType) {
    const result = await api.get(url, {
        params: params,
        responseType: responseType,
    }).catch(err => err);

    if (typeof result === 'string') throw result;


    return result.data;
}

async function post(url, data = {}, params = {}) {
    const result = await api.post(url, data, {
        params: params,
    });

    if (result.data.data) return result.data;

    return result;
}

async function put(url, data = {}, params = {}) {
    const result = await api.put(url, data, {
        params: params,
    });

    if (typeof result === 'string') throw result;

    if (result.data.data) return result.data;
    return result;
}

function destroy(url, params = {}) {
    return api.delete(url, {
        params: params,
    });
}

export {
    get,
    post,
    put,
    destroy,
};

import axios from 'axios';

async function get(url, params = {}) {
    const result = await axios.get(url, {
        params: params,
    }).catch(err => err);

    if (typeof result === 'string') throw result;

    return result.data;
}

async function post(url, data = {}, params = {}) {
    const result = await axios.post(url, data, {
        params: params,
    });

    if (result.data.data) return result.data;

    return result;
}

async function put(url, data = {}, params = {}) {
    const result = await axios.put(url, data, {
        params: params,
    });

    if (typeof result === 'string') throw result;

    if (result.data.data) return result.data;
    return result;
}

function destroy(url, params = {}) {
    return axios.delete(url, {
        params: params,
    });
}

export {
    get,
    post,
    put,
    destroy,
};

import {get} from '../api/index.js';

function fetchAllCategories() {
    return get('categories');
}

export {
    fetchAllCategories,
};

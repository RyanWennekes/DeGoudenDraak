import {get} from '../api/index.js';

function fetchAllTables() {
    return get('tables');
}

export {
    fetchAllTables,
};

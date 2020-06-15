import {get} from '../api/index.js';

function fetchAllTables() {
    return get('admin/tables');
}

export {
    fetchAllTables,
};

import {get} from '../api/index.js';
import {put} from "./index";

function fetchAllTables() {
    return get('admin/tables');
}

function requestHelp(tableNo) {
    return put('updateTableOrder', {'tableNo': tableNo});
}

export {
    fetchAllTables,
    requestHelp
};

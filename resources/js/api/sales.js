import {get} from '../api/index.js';

function fetchSales(startDate, endDate) {
    return get('admin/sales', {
        start_date: startDate,
        end_date: endDate,
    });
}

export {
    fetchSales,
};

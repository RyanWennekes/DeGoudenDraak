<template>
    <v-row>
        <v-data-table
            v-show="!loading"
            :headers="headers"
            :items="mappedOrders"
            :itemsPerPage="itemsPerPage"
            :footer-props="pagination">
            <template #item="props">
                <tr>
                    <td>{{props.item.name}}</td>
                    <td class="text-center">{{props.item.created_at}}</td>
                    <td class="text-center">{{props.item.amount}}x</td>
                </tr>
            </template>
        </v-data-table>
        <v-skeleton-loader v-show="loading"
                           type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>
    </v-row>
</template>

<script>
import {fetchAllOrders} from '../../api/orders.js';
import dayjs from '../../plugin/dayJs.js';

export default {
    name: 'OrderResource',
    data() {
        return {
            valid: false,
            orders: [],
            loading: false,
        };
    },
    created() {
        this.getOrders();
    },
    computed: {
        itemsPerPage() {
            return 14;
        },
        pagination() {
            return {
                itemsPerPageOptions: [5, 14, 20, 50, -1],
            };
        },
        headers() {
            return [
                {text: 'Product', value: 'name'},
                {text: 'Besteld op', value: 'created_at', align: 'center'},
                {text: 'Aantal', value: 'amount', align: 'center'},
            ];
        },
        mappedOrders() {
            return this.orders.map(order => {
                return {
                    name: order.name,
                    amount: order.amount,
                    price: order.price,
                    created_at: dayjs(order.created_at).format('YYYY-MM-DD'),
                };
            });
        },
    },
    methods: {
        async getOrders() {
            this.loading = true;
            this.sales = await fetchAllOrders(dayjs().format('YYYY-MM-DD'));
            this.loading = false;
        },
    },
};
</script>

<style scoped>

</style>

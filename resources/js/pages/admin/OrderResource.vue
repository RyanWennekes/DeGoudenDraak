<template>
    <div>
        <v-data-table
            v-show="!loading"
            :headers="headers"
            :items="mappedOrders"
            :itemsPerPage="itemsPerPage"
            :footer-props="pagination">
            <template #item="props">
                <tr>
                    <td>
                        <v-badge :value="props.item.needs_help" color="red" content="Vraagt om bediening">
                            {{props.item.table_id}}.
                        </v-badge>
                    </td>
                    <td class="text-center">
                        <ul>
                            <li v-for="sale in props.item.sales">{{sale.amount}}x {{sale.product.name}} <br/>
                                <v-subheader v-show="sale.comment" class="red--text font-weight-bold">
                                    {{sale.comment}}
                                </v-subheader>
                            </li>
                        </ul>
                    </td>
                    <td class="text-center">{{props.item.created_at}}</td>
                </tr>
            </template>
        </v-data-table>
        <v-skeleton-loader v-show="loading"
                           type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>
    </div>
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
                {text: 'Tafelnummer', value: 'table_id'},
                {text: 'Producten', value: 'sales', align: 'center'},
                {text: 'Besteld op', value: 'created_at', align: 'center'},
            ];
        },
        mappedOrders() {
            return this.orders.map(order => {
                return {
                    table_id: order.table_id,
                    needs_help: order.needs_help,
                    sales: order.sales,
                    created_at: dayjs(order.created_at).format('YYYY-MM-DD hh:mm:ss'),
                };
            });
        },
    },
    methods: {
        async getOrders() {
            this.loading = true;
            this.orders = await fetchAllOrders(dayjs().format('YYYY-MM-DD'));
            this.loading = false;
        },
    },
};
</script>

<style scoped>

</style>

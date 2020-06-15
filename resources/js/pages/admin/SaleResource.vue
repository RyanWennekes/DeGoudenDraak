<template>
    <v-row>
        <v-col cols="12" md="4" lg="3">
            <v-form v-model="valid" ref="form">
                <v-menu
                    v-model="startDateMenu"
                    transition="scale-transition"
                    offset-y
                    min-width="290px">
                    <template #activator="{ on }">
                        <v-text-field
                            v-model="startDate"
                            label="Begindatum"
                            prepend-icon="fas fa-calendar"
                            :rules="[(v) => !!v || 'Begindatum is verplicht']"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker v-model="startDate" no-title scrollable/>
                </v-menu>
                <v-menu
                    v-model="endDateMenu"
                    transition="scale-transition"
                    offset-y
                    min-width="290px">
                    <template #activator="{ on }">
                        <v-text-field
                            v-model="endDate"
                            label="Einddatum"
                            prepend-icon="fas fa-calendar"
                            :rules="[(v) => !!v || 'Einddatum is verplicht', (v) => !!v && endDateValidation || 'Einddatum moet naar startdatum vallen']"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker v-model="endDate" no-title scrollable/>
                </v-menu>

                <!-- Submit start &- enddate -->
                <v-btn color="primary" @click="handleSubmit">
                    Ophalen
                </v-btn>
            </v-form>
        </v-col>
        <v-col cols="12" md="8" lg="9">
            <v-data-table
                v-show="!loading"
                :headers="headers"
                :items="mappedSales"
                :itemsPerPage="itemsPerPage"
                :footer-props="pagination">
                <template #item="props">
                    <tr>
                        <td>{{props.item.name}}</td>
                        <td class="text-center">{{props.item.created_at}}</td>
                        <td class="text-center">{{props.item.amount}}x</td>
                        <td class="text-center">{{props.item.price | currency}}</td>
                    </tr>
                </template>
            </v-data-table>
            <v-skeleton-loader v-show="loading"
                               type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>
        </v-col>
    </v-row>
</template>

<script>
import {fetchSales} from '../../api/sales.js';
import dayjs from '../../plugin/dayJs.js';

export default {
    name: 'SaleResource',
    data() {
        return {
            valid: false,
            startDate: null,
            endDate: null,
            startDateMenu: false,
            endDateMenu: false,
            sales: [],
            loading: false,
            today: null,
        };
    },
    created() {
        this.today = dayjs().format('YYYY-MM-DD');
        this.getSales();
    },
    computed: {
        endDateValidation() {
            return !!dayjs(this.startDate).isBefore(dayjs(this.endDate));
        },
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
                {text: 'Totaal', value: 'price', align: 'center'},
            ];
        },
        mappedSales() {
            return this.sales.map(sale => {
                return {
                    name: sale.name,
                    amount: sale.amount,
                    price: sale.price,
                    created_at: dayjs(sale.created_at).format('YYYY-MM-DD'),
                };
            });
        },
    },
    methods: {
        async handleSubmit() {
            this.$refs.form.validate();

            if (this.valid) {
                await this.getSales();
            }
        },
        async getSales() {
            this.loading = true;
            this.sales = await fetchSales(this.startDate || this.today, this.endDate || this.today);
            this.loading = false;
        },
    },
};
</script>

<style scoped>

</style>

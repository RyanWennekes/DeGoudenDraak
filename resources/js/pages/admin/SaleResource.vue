<template>
    <v-row>
        <v-col cols="12" sm="4" md="3">
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
        <v-col cols="12" sm="8" md="9">
            <v-data-table
                :headers="headers"
                :items="sales"
                :itemsPerPage="itemsPerPage"
                :footer-props="pagination">
                <template #item="props">
                    <tr>
                        <td>{{props.item.name}}</td>
                        <td class="text-center">{{props.item.amount}}x</td>
                        <td class="text-center">{{props.item.price | currency}}</td>
                    </tr>
                </template>
            </v-data-table>
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
        };
    },
    created() {
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
                {text: 'Aantal', value: 'amount'},
                {text: 'Totaal', value: 'price'},
            ];
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
            this.sales = await fetchSales(this.startDate || dayjs().format('YYYY-MM-DD'), this.endDate || dayjs().format('YYYY-MM-DD'));
            this.loading = false;
        },
    },
};
</script>

<style scoped>

</style>

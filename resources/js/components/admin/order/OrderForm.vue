<template>
    <div>
        <h2 class="text-center">Bestelling</h2>
        <v-select
            v-model="selectedTable"
            label="Tafelnummer"
            :loading="loading"
            :items="tables"
            item-value="table_number"
            item-key="id"
            menu-props="auto"
            hide-details
        >
            <template #selection="{item}">{{item.table_number}}</template>
            <template #item="{item}">{{item.table_number}}</template>
        </v-select>
        <v-divider class="my-3"/>

        <v-simple-table :height="$vuetify.breakpoint.smAndDown ? '200px' : '550px'">
            <template #default>
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-left">Naam</th>
                        <th class="text-center">Aantal</th>
                        <th class="actions"></th>
                        <th></th>
                        <th class="text-center">Prijs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in value" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td class="text-center">{{ item.total }}x</td>
                        <td class="pa-0">
                            <v-btn icon color="blue" @click="$emit('addProduct', item)">
                                <v-icon>fa-plus</v-icon>
                            </v-btn>
                            <v-btn icon color="blue" @click="$emit('removeProduct', item)">
                                <v-icon>fa-minus</v-icon>
                            </v-btn>
                        </td>
                        <td class="text-center">{{ item.price | currency}}</td>
                        <td class="text-center">{{ (item.price * item.total) | currency}}</td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>

        <v-divider class="my-3"/>
        <h2 class="text-right px-4 mb-4">Totaal: {{summaryOrder | currency}}</h2>

        <v-row justify="center" class="ma-0" v-show="hasProducts">
            <!-- Remove order -->
            <v-btn color="error" text @click="deniedOrder" width="150">
                Verwijderen
            </v-btn>

            <!-- Pay order -->
            <v-btn color="success" @click="$emit('payOrder', selectedTable)" width="150">
                Betalen
            </v-btn>
        </v-row>
    </div>
</template>

<script>
import {fetchAllTables} from '../../../api/tables.js';

export default {
    name: 'OrderForm',
    props: ['value'],
    computed: {
        summaryOrder() {
            if (!this.hasProducts) return 0;

            let summary = 0;
            for (const product in this.value) {
                summary += (this.value[product].total * this.value[product].price);
            }
            return summary;
        },
        hasProducts() {
            return this.value && Object.keys(this.value).length > 0;
        },
    },
    data() {
        return {
            tables: [],
            loading: false,
            selectedTable: '',
        };
    },
    created() {
        this.getTables();
    },
    methods: {
        deniedOrder() {
            this.$emit('input', {});
        },
        async getTables() {
            this.loading = true;
            this.tables = await fetchAllTables();
            this.loading = false;
        },
    },
};
</script>

<style lang="scss">
.actions {
    min-width: 76px;
}
</style>

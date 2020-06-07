<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="products"
            :itemsPerPage="itemsPerPage"
            :footer-props="pagination"
            v-show="!loading"
        >
            <template #footer></template>
            <template #item.name="props">
                <v-edit-dialog
                    :return-value.sync="props.item.name"
                    @save="save"
                    @cancel="cancel"
                    @open="open"
                    @close="close"
                > {{ props.item.name }}
                    <template #input>
                        <v-text-field
                            v-model="props.item.name"
                            label="Edit"
                            single-line
                            counter
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>
            <template #item.minium_amount="props">
                <v-edit-dialog
                    :return-value.sync="props.item.iron"
                    large
                    persistent
                    @save="save"
                    @cancel="cancel"
                    @open="open"
                    @close="close"
                >
                    <div>{{ props.item.iron }}</div>
                    <template #input>
                        <div class="mt-4 title">Minimun aanpassen</div>
                    </template>
                    <template #input>
                        <v-text-field
                            v-model="props.item.iron"
                            label="Aanpassen"
                            single-line
                            counter
                            autofocus
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>
        </v-data-table>
        <v-skeleton-loader v-show="loading"
                           type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}
            <v-btn text @click="snack = false">Sluiten</v-btn>
        </v-snackbar>
    </div>
</template>

<script>
import {fetchAllProducts} from '../../api/products.js';

export default {
    name: 'ProductResource',
    data() {
        return {
            snack: false,
            snackColor: '',
            snackText: '',
            headers: [
                {
                    text: 'Naam',
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                {text: 'Code', value: 'code'},
                {text: 'Prijs', value: 'priceDiscount'},
                {text: 'Pittigheid', value: 'spiciness'},
                {text: 'Mininum aantal', value: 'minimum_amount'},
            ],
            products: [],
            loading: false,
        };
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
    },
    created() {
        this.getProducts();
    },
    methods: {
        async getProducts() {
            this.loading = true;
            this.products = await fetchAllProducts();
            this.loading = false;
        },
        save() {
            this.snack = true;
            this.snackColor = 'success';
            this.snackText = 'Veld is succesvol aangepast';
        },
        cancel() {
            this.snack = true;
            this.snackColor = 'error';
            this.snackText = 'Stopgezet';
        },
        open() {
            this.snack = true;
            this.snackColor = 'info';
            this.snackText = 'Veld is geopend';
        },
        close() {
        },
    },
};
</script>

<style scoped>

</style>

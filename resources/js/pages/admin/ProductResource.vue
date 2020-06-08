<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="products"
            :itemsPerPage="itemsPerPage"
            :footer-props="pagination"
            v-show="!loading">
            <template #item="props">
                <tr>
                    <td>{{props.item.id}}.</td>
                    <td>
                        <v-edit-dialog
                            :return-value.sync="props.item.name"
                            @save="save(props.item)"
                            @cancel="cancel"
                            @open="open"
                            @close="close"
                        > {{ props.item.name }} <span class="red--text font-weight-bold ml-1"
                                                      v-if="props.item.price !== props.item.discountPrice">Korting</span>
                            <template #input>
                                <v-text-field
                                    v-model="props.item.name"
                                    label="Edit"
                                    single-line
                                    counter
                                ></v-text-field>
                            </template>
                        </v-edit-dialog>
                    </td>
                    <td class="text-center">{{props.item.code}}</td>
                    <td class="text-center" v-if="props.item.price !== props.item.discountPrice">
                        <span class="old-price">{{props.item.price | currency}}</span>
                        <span class="red--text font-weight-bold ml-1">{{props.item.discountPrice | currency}}</span>
                    </td>
                    <td v-else class="text-center">{{props.item.price | currency}}</td>
                    <td class="text-center">
                        <ChipSpiciness :spiciness="props.item.spiciness"/>
                    </td>
                    <td class="text-center">{{props.item.minimum_amount || 'geen'}}</td>
                </tr>
            </template>
        </v-data-table>
        <v-skeleton-loader v-show="loading"
                           type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>

        <ProductForm @error="snackbarMessage" @successfulCreated="afterProductCreated"/>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}
            <v-btn text @click="snack = false">Sluiten</v-btn>
        </v-snackbar>
    </div>
</template>

<script>
import {fetchAllProducts, updateProduct} from '../../api/products.js';
import ChipSpiciness from '../../components/admin/ChipSpiciness.vue';
import ProductForm from '../../components/admin/forms/ProductForm.vue';

export default {
    name: 'ProductResource',
    components: {ProductForm, ChipSpiciness},
    data() {
        return {
            snack: false,
            snackColor: '',
            snackText: '',
            headers: [
                {text: 'Nummer', align: 'start', sortable: true, value: 'id'},
                {text: 'Naam', align: 'start', sortable: true, value: 'name'},
                {text: 'Code', value: 'code', align: 'center'},
                {text: 'Prijs', value: 'priceDiscount', align: 'center'},
                {text: 'Pittigheid', value: 'spiciness', sortable: true, align: 'center'},
                {text: 'Mininum aantal', value: 'minimum_amount', align: 'center'},
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
        save(product) {
            this.updateProduct(product);
            this.snackbarMessage('Veld is succesvol aangepast', 'success');
        },
        cancel() {
            this.snackbarMessage('Gestopt', 'error');
        },
        open() {
            this.snackbarMessage('Veld is geopend', 'info');
        },
        close() {
        },
        async updateProduct(product) {
            await updateProduct(product);
        },
        snackbarMessage(text, color) {
            this.snack = true;
            this.snackColor = text.color ? text.color : color;
            this.snackText = text.text ? text.text : text;
        },
        afterProductCreated(text, color) {
            this.snackbarMessage(text, color);
            this.getProducts();
        },
    },
};
</script>

<style lang="scss" scoped>
.old-price {
    text-decoration: line-through;
}
</style>

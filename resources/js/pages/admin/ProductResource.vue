<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="products"
            :itemsPerPage="itemsPerPage"
        >
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
                            :rules="[max25chars]"
                            label="Edit"
                            single-line
                            counter
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>
            <template #item.iron="props">
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
                        <div class="mt-4 title">Update Iron</div>
                    </template>
                    <template #input>
                        <v-text-field
                            v-model="props.item.iron"
                            :rules="[max25chars]"
                            label="Edit"
                            single-line
                            counter
                            autofocus
                        ></v-text-field>
                    </template>
                </v-edit-dialog>
            </template>
        </v-data-table>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}
            <v-btn text @click="snack = false">Close</v-btn>
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
            max25chars: v => v.length <= 25 || 'Input too long!',
            pagination: {},
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
        };
    },
    computed: {
        itemsPerPage() {
            return 12;
        },
    },
    created() {
        this.getProducts();
    },
    methods: {
        async getProducts() {
            this.products = await fetchAllProducts();
        },
        save() {
            this.snack = true;
            this.snackColor = 'success';
            this.snackText = 'Data saved';
        },
        cancel() {
            this.snack = true;
            this.snackColor = 'error';
            this.snackText = 'Canceled';
        },
        open() {
            this.snack = true;
            this.snackColor = 'info';
            this.snackText = 'Dialog opened';
        },
        close() {
            console.log('Dialog closed');
        },
    },
};
</script>

<style scoped>

</style>

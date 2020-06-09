<template>
    <v-dialog v-model="dialog" width="600">
        <template #activator="{ on }">
            <v-btn color="primary" dark v-on="on">Product aanmaken</v-btn>
        </template>
        <v-card>
            <v-card-title>Product aanmaken</v-card-title>
            <v-card-text>
                <v-form v-model="valid" ref="form">
                    <v-text-field
                        v-model="product.code"
                        label="Code*"
                        counter="45"
                        :rules="[(v) => !!v || 'Code is verplicht', (v) => !!v && v.length <= 45 || 'Code mag een maximale lengte hebben van 45 karakters']"/>
                    <v-select
                        v-model="product.product_type_id"
                        label="Categorie*"
                        :items="categories"
                        item-text="type_nl"
                        item-value="id"
                        :rules="[(v) => !!v || 'Categorie is verplicht']"/>

                    <v-text-field
                        v-model="product.name"
                        label="Naam*"
                        counter="100"
                        :rules="[(v) => !!v || 'Naam is verplicht', (v) => !!v && v.length <= 100 || 'Naam mag een maximale lengte hebben van 100 karakters']"/>
                    <v-text-field
                        v-model="product.price"
                        label="Prijs*"
                        type="number"
                        :rules="[(v) => !!v || 'Prijs is verplicht']"/>

                    <v-select
                        v-model="product.spiciness"
                        label="Pittigheid"
                        :items="spicinessOptions">
                        <template #item="{item}">
                            <div class="mr-1 spiciness-icon">
                                <v-icon :color="item.color">{{item.icon}}</v-icon>
                            </div>
                            {{item.text}}
                        </template>
                        <template #selection="{item}">
                            <div class="mr-1 spiciness-icon">
                                <v-icon :color="item.color">{{item.icon}}</v-icon>
                            </div>
                            {{item.text}}
                        </template>
                    </v-select>

                    <v-text-field
                        v-model="product.minimum_amount"
                        label="Minimale aantal personen"
                        type="number"/>

                    <v-textarea
                        v-model="product.description_nl"
                        label="Beschrijving in het Nederlands"/>
                    <v-textarea
                        v-model="product.description_en"
                        label="Beschrijving in het Engels"/>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="grey" text @click="handleClose">Terug</v-btn>
                <v-spacer/>
                <v-btn color="info" @click="handleCreate">Aanmaken</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {fetchAllProductsMinimized} from '../../../api/products.js';
import {createOffer} from '../../../api/offers.js';

export default {
    name: 'OfferForm',
    data() {
        return {
            valid: false,
            offer: {},
            products: [],
            dialog: false,
        };
    },
    created() {
        this.getProducts();
    },
    methods: {
        async getProducts() {
            this.product = await fetchAllProductsMinimized();
        },
        handleClose() {
            this.dialog = false;
            this.$refs.form.reset();
        },
        handleCreate() {
            this.$refs.form.validate();

            if (this.valid) {
                createOffer(this.offer)
                    .then(() => {
                        this.$emit('successfulCreated', {
                            text: 'Aanbieding is succesvol aangemaakt!',
                            color: 'success',
                        });
                        this.$refs.form.reset();
                        this.dialog = false;
                    })
                    .catch(() => {
                        this.$emit('error', {
                            text: 'Er is iets verkeerd gegaan...',
                            color: 'error',
                        });
                    });
            }
        },
    },
};
</script>

<style scoped>

</style>

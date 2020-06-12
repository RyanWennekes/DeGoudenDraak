<template>
    <v-dialog v-model="dialog" width="600">
        <template #activator="{ on }">
            <v-btn color="primary" dark v-on="on">Aanbieding plaatsen</v-btn>
        </template>
        <v-card>
            <v-card-title>Aanbieding plaatsen</v-card-title>
            <v-card-text>
                <v-form v-model="valid" ref="form">
                    <v-autocomplete
                        v-model="offer.product_id"
                        label="Product*"
                        :items="products"
                        item-text="name"
                        item-value="id"
                        :rules="[(v) => !!v || 'Product is verplicht']"
                        dense
                        filled />

                    <v-text-field
                        v-model="offer.discount"
                        label="Korting*"
                        :rules="[(v) => !!v || 'Korting is verplicht', (v) => !!v && v <= 100 && v >= 0 || 'Het moet een geldige korting zijn']">
                        <template #append>%</template>
                    </v-text-field>

                    <v-menu
                        v-model="startDateMenu"
                        transition="scale-transition"
                        offset-y
                        min-width="290px">
                        <template #activator="{ on }">
                            <v-text-field
                                v-model="offer.date_start"
                                label="Begindatum"
                                prepend-icon="fas fa-calendar"
                                :rules="[(v) => !!v || 'Begindatum is verplicht', (v) => !!v && startDateValidation || 'Begindatum moet minimaal één dag van te voren worden aangegeven']"
                                readonly
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker v-model="offer.date_start" no-title scrollable/>
                    </v-menu>
                    <v-menu
                        v-model="endDateMenu"
                        transition="scale-transition"
                        offset-y
                        min-width="290px">
                        <template #activator="{ on }">
                            <v-text-field
                                v-model="offer.date_end"
                                label="Einddatum"
                                prepend-icon="fas fa-calendar"
                                :rules="[(v) => !!v || 'Einddatum is verplicht', (v) => !!v && endDateValidation || 'Einddatum moet naar startdatum vallen']"
                                readonly
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker v-model="offer.date_end" no-title scrollable/>
                    </v-menu>
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
import dayjs from '../../../plugin/dayJs.js';

export default {
    name: 'OfferForm',
    data() {
        return {
            valid: false,
            offer: {},
            products: [],
            dialog: false,
            startDateMenu: false,
            endDateMenu: false,
        };
    },
    created() {
        this.getProducts();
    },
    computed: {
        endDateValidation() {
            return !!dayjs(this.offer.date_start).isBefore(dayjs(this.offer.date_end));
        },
        startDateValidation() {
            return !!dayjs().isBefore(dayjs(this.offer.date_start));
        },
    },
    methods: {
        async getProducts() {
            this.products = await fetchAllProductsMinimized();
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

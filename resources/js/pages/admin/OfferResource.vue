<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="offers"
            :itemsPerPage="itemsPerPage"
            :footer-props="pagination"
            v-show="!loading">
            <template #item="props">
                <tr>
                    <td><template>{{ props.item.name }}</template></td>
                    <td class="text-center">{{props.item.discount}}%</td>
                    <td>?verlopen</td>
                    <td class="text-center">{{props.item.date_start}}</td>
                    <td class="text-center">{{props.item.date_end}}</td>
                    <td>delete</td>
                </tr>
            </template>
        </v-data-table>
        <v-skeleton-loader v-show="loading"
                           type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>

        <OfferForm @error="snackbarMessage" @successfulCreated="afterOfferCreated"/>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}
            <v-btn text @click="snack = false">Sluiten</v-btn>
        </v-snackbar>
    </div>
</template>

<script>
import {fetchAllOffers} from '../../api/offers.js';
import OfferForm from '../../components/admin/forms/OfferForm.vue';
import dayjs from '../../plugin/dayJs.js';

export default {
    name: 'OfferResource',
    components: {OfferForm},
    data() {
        return {
            snack: false,
            snackColor: '',
            snackText: '',
            headers: [
                {text: 'Gerecht', align: 'start', sortable: true, value: 'name'},
                {text: 'Korting', value: 'discount', align: 'center'},
                {text: 'Termijn', value: '', align: ''},
                {text: 'Begint op', value: 'date_start', align: 'center'},
                {text: 'Eindigt op', value: 'date_end', align: 'center'},
                {text: '', value: '', align: ''},
            ],
            offers: [],
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
        this.getOffers();
    },
    methods: {
        async getOffers() {
            this.loading = true;
            this.offers = await fetchAllOffers();
            this.offers = this.offers.map((offer) => {
                return {
                    'name': offer.product.name,
                    'discount': offer.discount,
                    'date_start': dayjs(offer.date_start).format('YYYY-MM-DD hh:mm'),
                    'date_end': dayjs(offer.date_end).format('YYYY-MM-DD hh:mm'),
                };
            });
            this.loading = false;
        },
        snackbarMessage(text, color) {
            this.snack = true;
            this.snackColor = text.color ? text.color : color;
            this.snackText = text.text ? text.text : text;
        },
        afterOfferCreated(text, color) {
            this.snackbarMessage(text, color);
            this.getOffers();
        },
    },
};
</script>

<style scoped>

</style>

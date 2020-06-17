<template>
    <div>
        <h2 class="text-center">Bestelling</h2>
        <v-divider class="my-3"/>

        <!-- Able for selecting table numbers -->
        <v-select
            v-model="selectedTableId"
            label="Tafelnummer"
            :loading="loading"
            :items="tables"
            item-value="id"
            item-key="table_number"
            menu-props="auto"
            hide-details
            filled>
            <template #selection="{item}">{{item.table_number}}</template>
            <template #item="{item}">{{item.table_number}}</template>
            <template #prepend-inner>
                <v-icon color="primary" class="mr-2">fa-mobile-alt</v-icon>
            </template>
        </v-select>

        <!-- Table that displays the order -->
        <v-simple-table :height="$vuetify.breakpoint.smAndDown ? '200px' : '500px'">
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
                    <!-- Menu opens on hover for adding comments -->
                    <v-menu
                        v-for="item in value" :key="item.id"
                        open-on-hover
                        max-width="250"
                        offset-y
                        bottom>
                        <template #activator="{ on }">
                            <!-- Display of a product -->
                            <tr v-on="on">
                                <td>{{ item.id }}.</td>
                                <td v-html="item.name"></td>
                                <td class="text-center">{{ item.total }}x</td>
                                <td class="pa-0">
                                    <v-btn icon color="blue" @click="$emit('addProduct', item)">
                                        <v-icon>fa-plus</v-icon>
                                    </v-btn>
                                    <v-btn icon color="blue" @click="$emit('removeProduct', item)">
                                        <v-icon>fa-minus</v-icon>
                                    </v-btn>
                                </td>
                                <td class="text-center">{{ item.discountPrice | currency}}</td>
                                <td class="text-center">{{ (item.discountPrice * item.total) | currency}}</td>
                            </tr>
                        </template>
                        <v-list>
                            <v-list-item @click="addComment(item)" v-if="!item.comment">
                                <v-icon color="primary" class="mr-2">fa-plus</v-icon>
                                Opmerking toevoegen
                            </v-list-item>
                            <v-list-item @click="addComment(item)" v-else>
                                <v-icon color="green" class="mr-2">fa-edit</v-icon>
                                <span class="font-italic">{{item.comment}}</span>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </tbody>
            </template>
        </v-simple-table>

        <v-divider class="my-3"/>
        <h2 class="text-right px-4 mb-4">Totaal: {{summaryOrder | currency}}</h2>

        <!-- Actiosn buttons of form -->
        <v-row justify="center" class="ma-0" v-show="hasProducts">
            <v-col cols="auto">
                <!-- Remove order -->
                <v-btn color="error" text @click="deniedOrder" width="150">
                    Verwijderen
                </v-btn>

                <!-- Pay order -->
                <v-btn color="success" @click="payOrder" width="150" :disabled="this.selectedTableId === null">
                    Betalen
                </v-btn>
            </v-col>

            <v-subheader class="text-center">Er kan geen bestelling worden gemaakt zonder een tafelnummer te selecteren.</v-subheader>
        </v-row>

        <!-- Small dialog for adding a comment -->
        <v-dialog v-model="dialog" width="600" persistent>
            <v-card>
                <v-card-title>Opmerking toevoegen</v-card-title>
                <v-card-text>
                    <v-form ref="form" v-model="valid">
                        <v-textarea
                            v-model="comment"
                            label="Opmerking"
                            :counter="254"
                            :rules="[(v) => !!v && v.length <= 254 || 'Opmerking heeft een maximale lengte van 254 karakters']"
                        ></v-textarea>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn @click="onClose" text color="grey">Terug</v-btn>
                    <v-spacer/>
                    <v-btn @click="placeComment" color="info" :disabled="!valid">Toevoegen</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
                summary += (this.value[product].total * this.value[product].discountPrice);
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
            selectedTableId: null,
            dialog: false,
            selectedProduct: null,
            comment: '',
            valid: false,
        };
    },
    created() {
        this.getTables();
    },
    methods: {
        deniedOrder() {
            this.$emit('input', {});
        },
        payOrder() {
            this.$emit('payOrder', this.selectedTableId);
            this.selectedTableId = null;
        },
        async getTables() {
            this.loading = true;
            this.tables = await fetchAllTables();
            this.loading = false;
        },
        addComment(product) {
            this.selectedProduct = product;
            this.comment = product.comment;
            this.dialog = true;
        },
        onClose() {
            this.dialog = false;
            this.comment = '';
            this.$refs.form.reset();
        },
        placeComment() {
            this.$refs.form.validate();

            if (this.valid) {
                Vue.set(this.selectedProduct, 'comment', this.comment);
                this.onClose();
            }
        },
    },
};
</script>

<style lang="scss">
.actions {
    min-width: 76px;
}
</style>

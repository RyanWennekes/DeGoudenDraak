<template>
    <div>
        <h2 class="text-center">Producten</h2>
        <v-divider class="my-3"/>

        <v-text-field
            v-model="search"
            label="Zoeken"
            class="searchbar"
            hide-details
            filled>
            <template #prepend-inner>
                <v-icon color="primary" class="mr-2">fa-search</v-icon>
            </template>
        </v-text-field>

        <div class="overflow" :class="{'small' : $vuetify.breakpoint.smAndDown}">
            <v-list two-line subheader v-for="category in categories" :key="category.id" v-show="!loading">
                <v-subheader class="justify-center">{{category.type_nl}} <span class="font-weight-bold ml-1"
                                                                               v-if="category.has_rice">(met rijst)</span>
                </v-subheader>

                <template v-for="(product, index) in filteredProducts" v-if="product.product_type_id === category.id">
                    <v-list-item :key="`product-${index}`" class="product">
                        <v-list-item-content class="id-label">
                            {{product.id}}.
                        </v-list-item-content>

                        <v-list-item-content>
                            <v-list-item-title><span v-html="product.name"></span>
                                <span class="red--text font-weight-bold ml-1"
                                      v-if="product.price !== product.discountPrice">Korting</span></v-list-item-title>
                            <v-list-item-action-text class="pr-2"
                                                     v-html="product.description_nl"></v-list-item-action-text>
                        </v-list-item-content>

                        <v-list-item-content class="price-label">
                            {{product.discountPrice | currency}}
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-btn fab dark small color="blue" @click="addProduct(product)">
                                <v-icon small>fa-plus</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>

                    <!-- This divide items from each other-->
                    <v-divider :key="`divider-${index}`"></v-divider>
                </template>
            </v-list>
            <v-skeleton-loader
                v-if="loading"
                type="table-thead,table-tbody@3"
            ></v-skeleton-loader>
        </div>
    </div>
</template>

<script>
import {fetchAllProducts} from '../../../api/products.js';
import {fetchAllCategories} from '../../../api/category.js';

export default {
    name: 'ProductsTable',
    data() {
        return {
            products: null,
            categories: null,
            loading: false,
            search: '',
        };
    },
    created() {
        this.getCategories();
        this.getProducts();
    },
    computed: {
        filteredProducts() {
            return this.products.filter((product) => product.name.includes(this.search) || product.name.includes(this.search) || this.search.length === 0);
        },
    },
    methods: {
        addProduct(product) {
            this.$emit('addProduct', product);
        },
        async getCategories() {
            this.categories = await fetchAllCategories();
        },
        async getProducts() {
            this.loading = true;
            this.products = await fetchAllProducts();
            this.loading = false;
        },
    },
};
</script>

<style lang="scss">
.product {
    .id-label {
        max-width: 30px;
        text-align: center;
    }

    .price-label {
        max-width: 50px;
        text-align: center;
    }
}

.searchbar {
    max-width: 250px;
}
</style>

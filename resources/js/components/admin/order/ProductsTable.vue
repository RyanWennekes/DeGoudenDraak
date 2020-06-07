<template>
    <div>
        <h2 class="text-center">Producten</h2>
        <v-divider class="my-3"/>

        <div class="overflow" :class="{'small' : $vuetify.breakpoint.smAndDown}">
            <v-list two-line subheader v-for="category in categories" :key="category.id">
                <v-subheader class="justify-center">{{category.type_nl}} <span class="font-weight-bold ml-1" v-if="category.has_rice">(met rijst)</span></v-subheader>

                <template v-for="(product, index) in products" v-if="product.product_type_id === category.id">
                    <v-list-item :key="`product-${index}`" class="product">
                        <v-list-item-content class="id-label">
                            {{product.id}}.
                        </v-list-item-content>

                        <v-list-item-content>
                            <v-list-item-title>{{product.name}}</v-list-item-title>
                            <v-list-item-action-text class="pr-2">{{product.description}}</v-list-item-action-text>
                        </v-list-item-content>

                        <v-list-item-content class="price-label">
                            {{product.price | currency}}
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
        };
    },
    created() {
        this.getCategories();
        this.getProducts();
    },
    methods: {
        addProduct(product) {
            this.$emit('addProduct', product);
        },
        async getCategories() {
            this.categories = await fetchAllCategories();
        },
        async getProducts() {
            this.products = await fetchAllProducts();
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
</style>

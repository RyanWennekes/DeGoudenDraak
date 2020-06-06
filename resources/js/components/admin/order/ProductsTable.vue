<template>
    <!-- TODO : Loading and placing products here -->
    <div>
        <v-list two-line subheader v-for="category in categories" :key="category.id">
            <v-subheader class="justify-center">{{category.typeNl}}</v-subheader>

            <template v-for="(product, index) in products" v-if="product.categoryId === category.id">
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
                        <v-btn fab dark small color="blue">
                            <v-icon small>fa-plus</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list-item>

                <!-- This divide items from each other-->
                <v-divider :key="`divider-${index}`"></v-divider>
            </template>
        </v-list>
    </div>
</template>

<script>
import {fetchAllProducts} from '../../../api/products.js';
import {fetchAllCategories} from '../../../api/category.js';

export default {
    name: 'ProductsTable',
    props: {
        value: {
            type: Object,
            required: true,
        },
    },
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
        addProduct() {
            //
        },
        async getCategories() {
            this.categories = await fetchAllCategories();
            this.categories = [
                {id: 1, typeNl: 'Soep', typeEn: 'Soup'},
                {id: 2, typeNl: 'Voorgerecht', typeEn: 'Appetizer'},
            ];
        },
        async getProducts() {
            this.products = await fetchAllProducts();
            this.products = [
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 1,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 1,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 1,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 1,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 1,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                }, {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 2,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                    categoryId: 2,
                },
            ];
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

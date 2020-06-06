<template>
    <!-- TODO : Loading and placing products here -->
    <v-list two-line subheader>
        <v-subheader>Producten</v-subheader>

        <template v-for="(product, index) in products">
            <v-list-item :key="`product-${index}`" class="product">
                <v-list-item-content>
                    <v-list-item-title>{{product.name}}</v-list-item-title>
                    <v-list-item-subtitle>{{product.description}}</v-list-item-subtitle>
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
</template>

<script>
import {fetchAllProducts} from '../../../api/products.js';

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
        };
    },
    created() {
        this.getProducts();
    },
    methods: {
        addProduct() {
            //
        },
        async getProducts() {
            this.products = await fetchAllProducts();
            this.products = [
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
                {
                    name: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    id: 1,
                    price: 5.00,
                    description: 'Aliquam a rutrum tortor. Nullam porta orci molestie, volutpat sapien nec, malesuada nibh. Cras ipsum tellus, fermentum at luctus vitae, mattis eget ante. Donec sit amet nulla a nisi molestie vulputate. Donec ornare, nisl at bibendum venenatis, turpis ipsum interdum metus, finibus dapibus dui ligula et orci.',
                },
            ];
        },
    },
};
</script>

<style lang="scss">
.product {
    .price-label {
        max-width: 50px;
        text-align: center;
    }
}
</style>

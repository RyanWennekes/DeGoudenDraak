<template>
    <v-row align="stretch">
        <!-- Overview products -->
        <v-col cols="12" md="7">
            <ProductsTable @addProduct="addProduct"/>
        </v-col>

        <!-- Creating order -->
        <v-col cols="12" md="5">
            <OrderForm v-model="order" @addProduct="addProduct" @removeProduct="removeProduct" @payOrder="payOrder"/>
        </v-col>

        <v-snackbar v-model="message.show" :color="message.color" :timeout="3000">
            {{ message.text }}
            <v-btn color="white" text @click="message.show = false">
                Sluiten
            </v-btn>
        </v-snackbar>
    </v-row>
</template>

<script>
import OrderForm from '../../components/admin/order/OrderForm.vue';
import ProductsTable from '../../components/admin/order/ProductsTable.vue';
import {createOrder} from '../../api/orders.js';

export default {
    name: 'OrderResource',
    components: {ProductsTable, OrderForm},
    data() {
        return {
            order: {},
            message: {
                show: false,
            },
        };
    },
    methods: {
        addProduct(product) {
            if (this.order && !this.order[product.id]) {
                Vue.set(this.order, product.id, product);
            }

            Vue.set(this.order[product.id], 'total', this.order[product.id].total ? this.order[product.id].total + 1 : 1);
        },
        removeProduct(product) {
            if (this.order[product.id].total <= 1) {
                Vue.delete(this.order, product.id);
            } else {
                Vue.set(this.order[product.id], 'total', this.order[product.id].total - 1);
            }
        },
        payOrder(tableNumber) {
            createOrder({products: this.order, table_id: tableNumber})
                .then(() => {
                    this.message = {
                        show: true,
                        text: 'De bestelling is geplaatst! ',
                        color: 'success',
                    };

                    Vue.set(this, 'order', {});
                })
                .catch(() => {
                    this.message = {
                        show: true,
                        text: 'Er is iets misgegaan',
                        color: 'error',
                    };
                });
        },
    },
};
</script>

<style lang="scss">
.overflow {
    max-height: 730px;
    overflow-y: scroll;

    &.small {
        max-height: 360px;
    }
}
</style>

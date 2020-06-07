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
    </v-row>
</template>

<script>
import OrderForm from '../../components/admin/order/OrderForm.vue';
import ProductsTable from '../../components/admin/order/ProductsTable.vue';

export default {
    name: 'OrderResource',
    components: {ProductsTable, OrderForm},
    data() {
        return {
            order: {},
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
        payOrder(total) {
            console.log(`Persons payed: ${total}`);
            // this.order
        },
    },
};
</script>

<style lang="scss">
.overflow {
    max-height: 750px;
    overflow-y: scroll;

    &.small {
        max-height: 375px;
    }
}
</style>

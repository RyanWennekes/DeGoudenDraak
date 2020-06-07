<template>
    <v-row align="stretch">
        <!-- Overview products -->
        <v-col cols="12" md="7" class="overflow" :class="{'small' : $vuetify.breakpoint.smAndDown}">
            <ProductsTable @addProduct="addProduct"/>
        </v-col>

        <!-- Creating order -->
        <v-col cols="12" md="5" class="order-form">
            <OrderForm v-model="order" @addProduct="addProduct" @removeProduct="removeProduct"/>
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
            }

            Vue.set(this.order[product.id], 'total', this.order[product.id].total - 1);
        },
    },
};
</script>

<style lang="scss">
.overflow {
    overflow-y: scroll;
    position: absolute;
    max-height: 90%;

    &.small {
        max-height: 45%;
    }
}

.order-form {
    margin-left: auto;
}
</style>

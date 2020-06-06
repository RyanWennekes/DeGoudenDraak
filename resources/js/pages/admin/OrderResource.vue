<template>
    <v-row align="stretch">
        <!-- Overview products -->
        <v-col cols="12" md="7" lg="8" class="full-height overflow">
            <ProductsTable v-model="order"/>
        </v-col>

        <!-- Creating order -->
        <v-col cols="12" md="5" lg="4" class="full-height">
            <OrderForm v-model="order"/>
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
    created() {
        this.clearOrder();
    },
    methods: {
        clearOrder() {
            this.order = {};
        },
    },
};
</script>

<style lang="scss">
.overflow {
    overflow-y: scroll;
    position: absolute;
    max-height: 90%;
}
</style>

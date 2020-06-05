<template>
    <v-row align="stretch">
        <!-- Overview products -->
        <v-col cols="12" md="7" lg="8" class="full-height overflow">
            <OrderTable/>
        </v-col>

        <!-- Creating order -->
        <v-col cols="12" md="5" lg="4" class="full-height">
            <OrderForm/>
        </v-col>
    </v-row>
</template>

<script>
import OrderForm from '../../components/admin/order/OrderForm.vue';
import OrderTable from '../../components/admin/order/OrderTable.vue';

export default {
    name: 'OrderResource',
    components: {OrderTable, OrderForm},
};
</script>

<style lang="scss">
.overflow {
    overflow-y: scroll;
    position: absolute;
    max-height: 97%;
}
</style>

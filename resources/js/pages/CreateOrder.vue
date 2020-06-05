<template>
    <div>
        test
        <v-btn @click="testRequest">Create Auth request</v-btn>
    </div>
</template>

<script>
    import {fetchAllProducts} from '../api/products.js';

    export default {
        name: 'CreateOrder',
        methods: {
            async testRequest() {
                await fetchAllProducts();
            },
        },
    };
</script>

<style scoped>

</style>

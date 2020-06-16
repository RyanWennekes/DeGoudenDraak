<template>
    <i class="fas fa-plus" @click="increment"></i>
</template>

<script>
    export default {
        name: "add-dish",
        props: ['dish'],
        methods: {
            increment() {
                this.$globalEvents.$emit('increment', this.dish);
            }
        }
    }
</script>

<style scoped>

</style>

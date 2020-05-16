<template>
    <div>
        <h1>Startpagina</h1>
        <v-btn @click="$router.push({name: 'login'})">login</v-btn>
    </div>
</template>

<script>
    export default {
        name: 'Home',
        created() {
        },
    };
</script>

<style scoped>

</style>

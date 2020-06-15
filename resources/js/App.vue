<!-- we use vue-components and html inside the <template> tag -->
<template>
    <v-app data-app>
        <!-- router-view allows you to open different components with the router -->
        <router-view></router-view>
    </v-app>
</template>

<!-- we user javascript inside the <script> tag -->
<script>
    import DefaultLayout from './layouts/default.vue';

    export default {
        name: 'App',
        components: {DefaultLayout},
    };
</script>

<!-- we user css inside the <script> tag -->
<!-- always try using lang=scss -->
<style lang="scss">

</style>

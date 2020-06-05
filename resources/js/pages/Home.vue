<template>
    <div>
        <h1>Startpagina</h1>
    </div>
</template>

<script>
    import {createNamespacedHelpers} from 'vuex';

    const {mapActions} = createNamespacedHelpers('Authorization/');

    export default {
        name: 'Home',
        created() {
            //this.logout();
        },
        methods: {
            ...mapActions(['logout']),
        }
    };
</script>

<style scoped>

</style>

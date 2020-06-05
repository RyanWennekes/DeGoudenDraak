<template>
    <v-btn color="transparant" x-large dark icon absolute right bottom @click="onLogout">
        <v-icon large>fa-sign-out-alt</v-icon>
    </v-btn>
</template>

<script>
import {logout} from '../../api/authorization.js';
import {createNamespacedHelpers} from 'vuex';
const {mapActions, mapGetters} = createNamespacedHelpers('Authorization/');

export default {
    name: 'LogoutButton',
    methods: {
        ...mapActions(['setAccessToken']),
        async onLogout() {
            await logout(); //TODO: something goes wrong over here

            this.setAccessToken(null);
            await this.$router.push({name: 'home'});
            console.log("Has been logged out");
        },
    },
};
</script>

<style scoped>

</style>

<template>
    <v-btn color="white" x-large dark icon absolute right bottom @click="onLogout">
        <v-icon large>fa-sign-out-alt</v-icon>
    </v-btn>
</template>

<script>
import {logout} from '../../api/authorization.js';
import {createNamespacedHelpers} from 'vuex';
const {mapActions, mapGetters} = createNamespacedHelpers('Authorization/');

export default {
    name: 'LogoutButton',
    computed: {
        hasSmallerScreen() {
            return this.$vuetify.breakpoint.smAndDown;
        },
    },
    methods: {
        ...mapActions(['setAccessToken']),
        async onLogout() {
            await logout();
            this.setAccessToken('');
            await this.$router.push({name: 'home'});
            console.log("Has been logged out");
        },
    },
};
</script>

<style scoped>

</style>

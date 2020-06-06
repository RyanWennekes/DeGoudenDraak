<template>
    <v-btn :color="color" :outlined="!hasSmallerScreen" class="mb-5 logout-button" fab right absolute @click="onLogout">
        <v-icon color="white">fa-sign-out-alt</v-icon>
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
        color() {
            return this.hasSmallerScreen ? 'blue-grey darken-3' : 'white';
        },
    },
    methods: {
        ...mapActions(['setAccessToken']),
        async onLogout() {
            await logout();
            this.setAccessToken('');
            await this.$router.push({name: 'home'});
        },
    },
};
</script>

<style lang="scss">
.logout-button {
    bottom: 0;
}
</style>

<template>
    <v-overlay :value="overlay">
        <v-progress-circular
            :size="150"
            color="white"
            indeterminate
        ></v-progress-circular>
    </v-overlay>
</template>

<script>
import {fetchUserRoles} from '../../api/authorization.js';
import {createNamespacedHelpers} from 'vuex';

const {mapActions} = createNamespacedHelpers('Authorization/');

export default {
    name: 'LoadingScreen',
    data() {
        return {
            loading: false,
            timeoutEnded: false,
            timeout: null,
            overlay: true,
        };
    },
    created() {
        this.loading = true;

        // Creating a normal feeling, instead of loading every page very fast
        this.timeout = setTimeout(function () {
            this.timeoutEnded = true;
            this.loadNextPage();
        }.bind(this), 1000);

        this.getUserRoles();
    },
    methods: {
        ...mapActions(['setUserRoles']),
        async getUserRoles() {
            let rolesRequest = await fetchUserRoles();
            this.setUserRoles(rolesRequest.data);

            // load default route for every role
            this.loading = false;
            this.loadNextPage();
        },
        loadNextPage() {
            if (this.timeoutEnded && !this.loading) {
                this.$router.push({name: 'admin.index'});
            }
        },
    },
    destroyed() {
        clearTimeout(this.timeout);
    },
};
</script>

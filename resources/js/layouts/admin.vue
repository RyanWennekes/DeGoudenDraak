<template>
    <v-row justify="center" align="stretch" class="primary pa-6">
        <v-col cols="12" md="10" class="full-height">
            <v-card height="100%">
                <v-card-title>
                    <!-- TODO: Showing navigation based on role -->
                    <v-tabs grow show-arrows>
                        <v-tab :to="{name: 'admin.create.order'}">
                            Bestelling aanmaken
                        </v-tab>
                        <v-tab :to="{name: 'admin.products'}">
                            Producten
                        </v-tab>
                        <v-tab :to="{name: 'admin.test'}">
                            Another Selection
                        </v-tab>
                    </v-tabs>
                </v-card-title>

                <v-card-text>
                    <router-view></router-view>
                </v-card-text>
            </v-card>
        </v-col>
        <LogoutButton/>
    </v-row>
</template>

<script>
import LogoutButton from '../components/admin/LogoutButton.vue';
import {createNamespacedHelpers} from 'vuex';

const {mapGetters} = createNamespacedHelpers('Authorization/');

export default {
    name: 'AdminLayout',
    components: {LogoutButton},
    computed: {
        ...mapGetters(['isAdmin','isCashier', 'isWaitress', 'hasRole']),
    },
    created() {
        // This should only happen when the roles are not loaded
        if(!this.hasRole && this.$route.name !== 'admin.loading') this.$router.push({name: 'admin.loading'})
    },
};
</script>

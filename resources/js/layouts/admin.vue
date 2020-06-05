<template>
    <v-row justify="center" align="stretch" class="primary pa-6">
        <v-col cols="12" md="10" class="full-height">
            <v-card height="100%">
                <v-card-title>
                    <v-tabs fixed-tabs>
                        <v-tab :to="{name: 'admin.create.order'}">
                            Bestelling aanmaken
                        </v-tab>
                        <v-tab :to="{name: 'admin.test'}">
                            Another Selection
                        </v-tab>
                        <v-tab>
                            Items
                        </v-tab>
                        <v-tab>
                            Another Screen
                        </v-tab>
                    </v-tabs>
                </v-card-title>

                <v-card-text>
                    <router-view></router-view>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
export default {
    name: 'AdminLayout',
};
</script>

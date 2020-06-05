<template>
    <v-row justify="center" align="stretch" class="primary pa-6">
        <v-col cols="12" md="10" class="full-height">
            <v-card height="100%">
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

<style scoped>

</style>

<template>
    <v-row justify="center" align="center" class="ma-0">
        <v-card flat color="transparent">
            <v-card-title class="justify-center">
                <v-icon size="130">far fa-frown</v-icon>
            </v-card-title>
            <v-card-text class="text-center">
                <h2 class="display-3">404</h2>
                <h3 class="display-1">Pagina niet gevonden!</h3>
                <v-btn @click="$router.push({name: 'home'})" class="ma-2">Terug naar startpagina</v-btn>
            </v-card-text>
        </v-card>
    </v-row>
</template>

<script>
    export default {
        name: 'Page404',
    };
</script>

<style scoped>

</style>

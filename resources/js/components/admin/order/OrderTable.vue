<template>
    <!-- TODO : Loading and placing products here -->
    <v-list two-line subheader>
        <v-subheader>Producten</v-subheader>

        <template v-for="index in 20">
            <v-list-item :key="`product-${index}`">
                <v-list-item-content>
                    <v-list-item-title>title</v-list-item-title>
                    <v-list-item-subtitle>subtitle</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-action>
                    <v-btn fab dark small color="blue">
                        <v-icon small>fa-plus</v-icon>
                    </v-btn>
                </v-list-item-action>
            </v-list-item>

            <!-- This divide items from each other-->
            <v-divider :key="`divider-${index}`"></v-divider>
        </template>
    </v-list>
</template>

<script>
export default {
    name: 'OrderTable',
};
</script>

<style scoped>

</style>

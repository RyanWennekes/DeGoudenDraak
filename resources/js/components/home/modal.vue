<template>
    <v-dialog v-model="dialog" width="500">
        <v-card>
            <v-card-text class="pt-3 text-center">
                <p>{{ text }}</p>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-btn color="grey" text @click="dialog = false">{{ $t('table.closeDialog') }}</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "modal",
        props: ['text'],
        data() {
            return {
                dialog: false,
            }
        },
        methods: {
            show() {
                this.dialog = true;
            }
        }
    }
</script>

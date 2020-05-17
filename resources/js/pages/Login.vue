<template>
    <v-row justify="center" align="center" class="ma-0 primary">
        <v-card flat color="white" width="350">
            <v-card-title class="justify-center">
                <h1 class="my-4">Inloggen</h1>
            </v-card-title>
            <v-card-text class="text-center">
                <v-form ref="form" v-model="valid">
                    <v-text-field
                        label="Gebruikersnaam"
                        append-icon="fa-user"
                        :rules="[(v) => !!v || 'Gebruikersnaam is verplicht']"
                        outlined
                        v-model="email"
                    ></v-text-field>
                    <v-text-field
                        label="Wachtwoord"
                        append-icon="fa-key"
                        type="password"
                        :rules="[(v) => !!v || 'Wachtwoord is verplicht']"
                        outlined
                        v-model="password"
                    ></v-text-field>

                    <v-btn text color="primary">Wachtwoord vergeten</v-btn>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn text color="grey" @click="$router.push({name: 'home'})">Terug</v-btn>
                <v-spacer/>
                <v-btn color="primary" @click="onLogin">Inloggen</v-btn>
            </v-card-actions>
        </v-card>
    </v-row>
</template>

<script>
    import {login, logout} from '../api/authorization.js';
    import {createNamespacedHelpers} from 'vuex';

    const {mapState, mapGetters} = createNamespacedHelpers('Authorization/');

    export default {
        name: 'Login',
        data() {
            return {
                valid: false,
                email: '',
                password: '',
            };
        },
        computed: {
            ...mapGetters(['isLoggedIn']),
        },
        created() {
            this.onLogout();
        },
        methods: {
            onLogin() {
                login(this.email, this.password).then(() => {
                    console.log('loggedIn!');
                }).catch(() => {
                    console.log('oh no!');
                });
            },
            onLogout() {
                logout();
            }
        },
    };
</script>

<style scoped>

</style>

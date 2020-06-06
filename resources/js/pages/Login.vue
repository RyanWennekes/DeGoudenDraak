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
                        :rules="[(v) => !!v || 'Gebruikersnaam is verplicht', rules('email')]"
                        outlined
                        v-model="email"
                    ></v-text-field>
                    <v-text-field
                        label="Wachtwoord"
                        append-icon="fa-key"
                        type="password"
                        :rules="[(v) => !!v || 'Wachtwoord is verplicht', rules('password')]"
                        outlined
                        v-model="password"
                    ></v-text-field>

                    <v-btn text color="primary">Wachtwoord vergeten</v-btn>
                </v-form>
            </v-card-text>
            <v-card-actions class="px-3 pb-4">
                <v-btn text color="grey" @click="$router.push({name: 'home'})">Terug</v-btn>
                <v-spacer/>
                <v-btn color="primary" @click="beforeLogin" :loading="loading">Inloggen</v-btn>
            </v-card-actions>
        </v-card>
    </v-row>
</template>

<script>
import {login, fetchApiToken} from '../api/authorization.js';
import {createNamespacedHelpers} from 'vuex';
import MapRequestErrors from '../mixins/mapRequestErrors.js';

const {mapActions, mapGetters} = createNamespacedHelpers('Authorization/');

export default {
    name: 'Login',
    mixins: [MapRequestErrors],
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
    methods: {
        beforeLogin() {
            this.$refs.form.validate();

            if (this.valid) {
                this.onLogin();
            }
        },
        onLogin() {
            this.loading = true;

            login(this.email, this.password).then(async () => {
                // Set access token
                const tokenRequest = await fetchApiToken();
                this.setAccessToken(tokenRequest.data);
                await this.$router.push({name: 'admin.test'});
            }).catch(e => this.failedRequestResult = e).finally(() => {
                this.loading = false;
            });
        },
        ...mapActions(['setAccessToken']),
    },
};
</script>

<style scoped>

</style>

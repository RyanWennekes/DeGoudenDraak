<template>
    <v-dialog v-model="dialog" width="600">
        <template #activator="{ on }">
            <v-btn color="primary" dark v-on="on">Gebruiker aanmaken</v-btn>
        </template>
        <v-card>
            <v-card-title>Gebruiker aanmaken</v-card-title>
            <v-card-text>
                <v-form v-model="valid" ref="form">
                    <v-text-field
                        v-model="user.name"
                        label="Naam*"
                        counter="254"
                        :rules="[(v) => !!v || 'Naam is verplicht', (v) => !!v && v.length <= 254 || 'Naam mag een maximale lengte hebben van 254 karakters']"/>

                    <!-- TODO: select rol -->
                    <v-select
                        v-model="user.role"
                        label="Toegangsrechten"
                        :items="userRoles">
                        <template #item="{item}">
                            <div class="mr-1 role-icon">
                                <v-icon color="primary">{{item.icon}}</v-icon>
                            </div>
                            {{item.text}}
                        </template>
                        <template #selection="{item}">
                            <div class="mr-1 role-icon">
                                <v-icon color="primary">{{item.icon}}</v-icon>
                            </div>
                            {{item.text}}
                        </template>
                    </v-select>

                    <v-text-field
                        v-model="user.email"
                        label="Email*"
                        counter="254"
                        :rules="[(v) => !!v || 'Email is verplicht', (v) => !!v && v.length <= 254 || 'Email mag een maximale lengte hebben van 254 karakters']"/>
                    <v-text-field
                        v-model="user.password"
                        label="Wachtwoord*"
                        type="password"
                        counter="80"
                        :rules="[(v) => !!v || 'Wachtwoord is verplicht', (v) => !!v && v.length <= 80 || 'Wachtwoord mag een maximale lengte hebben van 80 karakters']"/>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="grey" text @click="handleClose">Terug</v-btn>
                <v-spacer/>
                <v-btn color="info" @click="handleCreate">Aanmaken</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {UserRoles, UserRolesIcon, UserRolesText} from '../../../enums/User.js';

import {createUser} from '../../../api/users.js';

export default {
    name: 'UserForm',
    data() {
        return {
            valid: false,
            user: {},
            dialog: false,
        };
    },
    computed: {
        userRoles() {
            let options = [];

            for (let role in UserRoles) {
                options.push({
                    'value': UserRoles[role],
                    'text': UserRolesText[UserRoles[role]],
                    'icon': UserRolesIcon[UserRoles[role]],
                });
            }

            return options;
        },
    },
    methods: {
        handleClose() {
            this.dialog = false;
            this.$refs.form.reset();
        },
        handleCreate() {
            this.$refs.form.validate();

            if (this.valid) {
                createUser(this.user)
                    .then(() => {
                        this.$emit('successfulCreated', {
                            text: 'Gebruiker is succesvol aangemaakt!',
                            color: 'success',
                        });
                        this.$refs.form.reset();
                        this.dialog = false;
                    })
                    .catch(() => {
                        this.$emit('error', {
                            text: 'Er is iets misgegaan',
                            color: 'error',
                        });
                    });
            }
        },
    },
};
</script>

<style scoped>
.role-icon {
    width: 42px;
    text-align: center;
}
</style>

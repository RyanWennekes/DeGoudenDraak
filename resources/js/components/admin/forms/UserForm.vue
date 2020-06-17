<template>
    <v-dialog v-model="dialog" width="600">
        <template #activator="{ on }">
            <v-btn color="primary" dark v-on="on">Gebruiker aanmaken</v-btn>
        </template>
        <v-card>
            <v-card-title>Gebruiker {{text}}</v-card-title>
            <v-card-text>
                <v-form v-model="valid" ref="form">
                    <v-text-field
                        v-model="user.name"
                        label="Naam*"
                        counter="254"
                        :rules="[(v) => !!v || 'Naam is verplicht', (v) => !!v && v.length <= 254 || 'Naam mag een maximale lengte hebben van 254 karakters']"/>

                    <v-select
                        v-model="user.role"
                        v-if="!isUpdateForm"
                        label="Toegangsrechten"
                        :items="userRoles"
                        :rules="[(v) => !!v || 'Toegangsrecht is verplicht']">
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
                        :rules="[() => (!!v || isUpdateForm)  || 'Wachtwoord is verplicht', (v) => isUpdateForm || !!v && v.length <= 80 || 'Wachtwoord mag een maximale lengte hebben van 80 karakters']"/>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="grey" text @click="handleClose">Terug</v-btn>
                <v-spacer/>
                <v-btn color="info" @click="handleSubmit">{{text}}</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {UserRoles, UserRolesIcon, UserRolesText} from '../../../enums/User.js';

import {createUser, updateUser} from '../../../api/users.js';

export default {
    name: 'UserForm',
    data() {
        return {
            valid: false,
            user: {},
            dialog: false,
            text: '',
        };
    },
    watch: {
        user() {
            if (this.user && !!this.user.id) {
                this.text = 'bewerken';
            } else {
                this.text = 'aanmaken';
            }
        },
        dialog() {
            if (this.dialog) {
                this.user = {};
            }
        },
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
        isUpdateForm() {
            return this.user && !!this.user.id;
        },
    },
    methods: {
        handleClose() {
            this.dialog = false;
            this.$refs.form.reset();
        },
        handleSubmit() {
            this.$refs.form.validate();

            if (this.valid) {
                if (this.isUpdateForm) this.handleUpdate();
                else this.handleCreate();
            }
        },
        handleCreate() {
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
        },
        async openUpdateForm(user) {
            this.dialog = true;

            this.$nextTick(() => {
                this.$refs.form.reset();
                this.user.id = user.id;
                this.user.name = user.name;
                this.user.email = user.email;
            });
        },
        async handleUpdate() {
            updateUser(this.user).then(() => {
                    this.$emit('successfulCreated', {
                        text: 'Gebruiker is succesvol bewerkt!',
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
        },
    },
}
;
</script>

<style scoped>
.role-icon
{
    width:      42px;
    text-align: center;
}
</style>

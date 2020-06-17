<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="users"
            :itemsPerPage="itemsPerPage"
            :footer-props="pagination"
            v-show="!loading">
            <template #item="props">
                <tr>
                    <td>{{props.item.id}}.</td>
                    <td>
                        <ChipUserRole :role="props.item.role"/>
                    </td>
                    <td>{{props.item.name}}</td>
                    <td>{{props.item.email}}</td>
                    <td>
                        <v-row justify="space-between" class="pa-1">
                            <v-tooltip left :disabled="!deleteDisabled(props.item.role)">
                                <template #activator="{ on }">
                                    <div v-on="on">
                                        <v-btn @click="handleDelete(props.item)"
                                               color="error"
                                               small
                                               fab
                                               :disabled="deleteDisabled(props.item.role)">
                                            <v-icon small>fa-trash</v-icon>
                                        </v-btn>
                                    </div>
                                </template>
                                <span>Een gebruiker met admin-rechten kan niet worden verwijderd</span>
                            </v-tooltip>

                            <v-btn @click="handleUpdate(props.item)"
                                   color="success"
                                   small
                                   fab>
                                <v-icon small>fa-pen</v-icon>
                            </v-btn>
                        </v-row>
                    </td>
                </tr>
            </template>
        </v-data-table>
        <v-skeleton-loader v-show="loading"
                           type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>

        <UserForm @error="snackbarMessage" @successfulCreated="afterUserCreated" ref="UserForm"/>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}
            <v-btn text @click="snack = false">Sluiten</v-btn>
        </v-snackbar>
    </div>
</template>

<script>
import UserForm from '../../components/admin/forms/UserForm.vue';
import {fetchAllUsers, deleteUser} from '../../api/users.js';
import ChipUserRole from '../../components/admin/ChipUserRole.vue';
import {UserRoles} from '../../enums/User.js';

export default {
    name: 'UserResource',
    components: {ChipUserRole, UserForm},
    data() {
        return {
            snack: false,
            snackColor: '',
            snackText: '',
            headers: [
                {text: 'Nummer', align: 'start', sortable: true, value: 'id', width: '100'},
                {text: 'Toegangsrechten', value: 'role', align: 'center', width: '170'},
                {text: 'Naam', value: 'name', align: 'left'},
                {text: 'Emailadres', value: 'email', align: 'left'},
                {text: '', value: '', align: '', width: '105'},
            ],
            users: [],
            loading: false,
        };
    },
    computed: {
        itemsPerPage() {
            return 14;
        },
        pagination() {
            return {
                itemsPerPageOptions: [5, 14, 20, 50, -1],
            };
        },
    },
    created() {
        this.getUsers();
    },
    methods: {
        async getUsers() {
            this.loading = true;
            this.users = await fetchAllUsers();
            this.loading = false;
        },
        snackbarMessage(text, color) {
            this.snack = true;
            this.snackColor = text.color ? text.color : color;
            this.snackText = text.text ? text.text : text;
        },
        afterUserCreated(text, color) {
            this.snackbarMessage(text, color);
            this.getUsers();
        },
        handleDelete(user) {
            deleteUser(user)
                .then(() => {
                    this.snackbarMessage('Gebruiker is succesvol verwijderd', 'success');
                    this.getUsers();
                })
                .catch(() => {
                    this.snackbarMessage('Er is iets misgegaan', 'error');
                });
        },
        handleUpdate(user) {
            this.$refs.UserForm.openUpdateForm(user);
        },
        deleteDisabled(role) {
            return role === UserRoles.ADMIN;
        },
    },
};
</script>

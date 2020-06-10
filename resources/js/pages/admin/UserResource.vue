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
                    <td>{{props.item.name}}</td>
                    <td class="text-center">{{props.item.role}}</td>
                    <td>
                        <v-btn @click="handleDelete(props.item)" color="error" small fab>
                            <v-icon small>fa-trash</v-icon>
                        </v-btn>
                    </td>
                </tr>
            </template>
        </v-data-table>
        <v-skeleton-loader v-show="loading"
                           type="table-heading,table-thead,table-tbody@2,table-tfoot"></v-skeleton-loader>

        <UserForm @error="snackbarMessage" @successfulCreated="afterUserCreated"/>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}
            <v-btn text @click="snack = false">Sluiten</v-btn>
        </v-snackbar>
    </div>
</template>

<script>
import UserForm from '../../components/admin/forms/UserForm.vue';
import {fetchAllUsers} from '../../api/users.js';

export default {
    name: 'UserResource',
    components: {UserForm},
    data() {
        return {
            snack: false,
            snackColor: '',
            snackText: '',
            headers: [
                {text: 'Nummer', align: 'start', sortable: true, value: 'id', width: '100'},
                {text: 'Naam', value: 'name', align: 'left'},
                {text: 'Toegangsrechten', value: 'role', align: 'center'},
                {text: '', value: '', align: '', width: '60'},
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
        handleDelete() {
            console.log('handling delete');
        },
    },
};
</script>

<style scoped>

</style>

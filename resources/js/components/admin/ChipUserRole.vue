<template>
    <v-chip>
        <v-icon small class="mr-2">{{icon}}</v-icon>
        {{text}}
    </v-chip>
</template>

<script>
import {UserRolesIcon, UserRolesText} from '../../enums/User.js';

export default {
    name: 'ChipUserRole',
    props: {
        role: {
            type: Number,
            required: true,
        },
    },
    computed: {
        text() {
            return UserRolesText[this.role];
        },
        icon() {
            return UserRolesIcon[this.role];
        },
    },
};
</script>

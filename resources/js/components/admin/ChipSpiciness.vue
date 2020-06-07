<template>
    <v-chip :color="color" class="white--text" v-show="spiciness != null">{{text}}</v-chip>
</template>

<script>
export default {
    name: 'ChipSpiciness',
    props: {
        spiciness: {
            type: Number,
            default: null,
        },
    },
    computed: {
        color() {
            switch (this.spiciness) {
                case 1:
                    return 'yellow darken-2';
                case 2:
                    return 'orange';
                case 3:
                    return 'red';
                default:
                    return 'grey';
            }
        },
        text() {
            switch (this.spiciness) {
                case 1:
                    return 'Warm';
                case 2:
                    return 'Heet';
                case 3:
                    return 'Extra heet';
                default:
                    return 'geen';
            }
        },
    },
};
</script>

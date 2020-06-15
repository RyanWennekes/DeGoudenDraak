<template>
    <v-chip :color="color" v-html="text"/>
</template>

<script>
import dayjs from '../../plugin/dayJs.js';

export default {
    name: 'PeriodExpired',
    props: {
        date_start: {
            type: String,
            required: true,
        },
        date_end: {
            type: String,
            required: true,
        },
    },
    computed: {
        hasExpired() {
            return dayjs(dayjs(this.date_end).format('YYYY-MM-DD 23:59:59')).isBefore(dayjs());
        },
        hasStarted() {
            return !dayjs().isBefore(dayjs(this.date_start));
        },
        text() {
            if (this.hasStarted)
                return this.hasExpired ? 'Verlopen' : 'Bezig';

            return 'Binnenkort';
        },
        color() {
            if (this.hasStarted)
                return this.hasExpired ? 'error' : 'primary white--text';

            return 'grey white--text';
        },
    },
};
</script>

<style scoped>

</style>

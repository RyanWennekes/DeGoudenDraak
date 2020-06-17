<template>
    <div>
        <span>
            <span>
                {{ $t('table.basket.tableNumber') + ":"}}
                <input type="number" v-model="tableNumber" @change="$emit('changeTables', tableNumber)" class="tableNo">
            </span>
            <span>{{ $t('table.basket.total') + ": &euro;" + total | currency}}</span>
            <i class="fas fa-shopping-basket" @click="order"></i>
            <i class="fas fa-question-circle" @click="help"></i>
        </span>
    </div>
</template>

<script>
    export default {
        name: "basket",
        props: ['total', 'order', 'tableNo', 'help'],
        data() {
            return {
                tableNumber: this.tableNo
            }
        }
    }
</script>

<style scoped>
    .fas {
        font-size: 30px;
        padding: 0 10px;
    }

    .fas:hover {
        color: #555555;
        cursor: pointer;
    }

    .tableNo {
        width: 50px;
        -webkit-appearance: none;
        margin: 0;
        -moz-appearance: textfield;
        text-align: right;
    }

    .tableNo::-webkit-outer-spin-button,
    .tableNo::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

</style>

<template>
    <div class="counter">
        <i class="fas fa-minus" @click="decrement"></i>
        <input type="number" v-model="count" min="0" max="100">
        <i class="fas fa-plus" @click="increment"></i>
    </div>
</template>

<script>
    export default {
        name: "counter",
        props: ['count'],
        methods: {
            decrement() {
                this.$emit('decr');
            },
            increment() {
                this.$emit('incr');
            }
        }
    }
</script>

<style lang="scss" scoped>
    .counter {
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
    }

    i {
        color: #590909;
    }

    i:hover {
        color: #8A1D1D;
        cursor: pointer;
    }

    input {
        outline: none;
        border: 2px solid #590909;
        border-radius: 50px;
        font-weight: bold;
        color: #590909;
        text-align: center;
        width: 40px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

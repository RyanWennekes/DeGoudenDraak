<template>
    <button type="submit" class="btn" @click="action"><slot></slot></button>
</template>

<script>
    export default {
        props: ['action'],
        name: "theme-button"
    }
</script>

<style scoped>
    @font-face {
        font-family: main;
        src: url('/fonts/main.ttf');
    }

    button.btn {
        font-family: main, sans-serif;
        background: #590909;
        color: #E79752;
        box-shadow: 0 0 5px 0 black;
        padding: 10px 20px;
        border-radius: 20px;
        outline: none;
        display: block;
        width: 100%;
        margin: 20px 0;
    }
</style>

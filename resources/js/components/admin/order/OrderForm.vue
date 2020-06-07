<template>
    <div>
        <h1>{{value[0]}}</h1>
        {{value}}
    </div>
</template>

<script>
export default {
    name: 'OrderForm',
    props: ['value'],
};
</script>

<style scoped>

</style>

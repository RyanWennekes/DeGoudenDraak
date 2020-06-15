<template>
    <div>
        <h1 class="theme-heading">{{ $t('news.title') }}</h1>
        <p class="message">{{ $t('news.message') }}</p>
    </div>
</template>

<script>
    export default {
        name: "News"
    }
</script>

<style scoped>
    p.message {
        background: white;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 0 5px 0 black;
        text-align: center;
    }
</style>

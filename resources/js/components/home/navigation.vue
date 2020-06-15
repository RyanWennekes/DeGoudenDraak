<template>
    <div class="header">
        <h2>
            {{ $t('subtitle') }}
        </h2>
        <h1>
            {{ $t('title') }}
        </h1>
        <ul class="navigation">
            <li><router-link :to="{name: 'home.menu'}">{{ $t('navigation.menu') }}</router-link></li>
            <li><router-link :to="{name: 'home.news'}">{{ $t('navigation.news') }}</router-link></li>
            <li><router-link :to="{name: 'home.contact'}">{{ $t('navigation.contact') }}</router-link></li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "navigation"
    }
</script>

<style lang="scss" scoped>

    @font-face {
        font-family: main;
        src: url('/fonts/main.ttf');
    }

    .header {
        text-align: center;
        font-family: main, sans-serif;
        color: #E79752;
    }

    ul.navigation {
        list-style-type: none;
        padding: 0;
        margin: 20px auto;

        li {
            display: inline-block;

            a {
                display: inline-block;
                background: #590909;
                box-shadow: 0 0 5px 0 black;
                color: #E79752;
                padding: 10px 20px;
                text-decoration: none;
                font-weight: bold;
                border-bottom: 2px solid transparent;
                border-radius: 10px;
            }

            a:hover {
                border-bottom: 2px solid #E79752;
            }
        }
    }
</style>

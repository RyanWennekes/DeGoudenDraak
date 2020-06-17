<template>
    <!-- v-app allows you to use all vuetify classes  -->
    <div class="outer">
        <div id="lang">
            <img src="/pictures/home/nl.svg" class="icon" @click="selectLocale('nl', $i18n)">
            <img src="/pictures/home/en.svg" class="icon" @click="selectLocale('en', $i18n)">
        </div>
        <div class="inner">
            <navigation></navigation>
            <div class="page">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import navigation from '../components/home/navigation.vue';
    export default {
        name: 'DefaultLayout',
        components: {navigation},
        methods: {
            selectLocale(locale, instance) {
                instance.locale = locale;
            }
        }
    };
</script>

<style lang="scss" scoped>
    .outer, .inner {
        height: 100%;
    }

    .outer {
        background-image: linear-gradient(to bottom right, #590909, #3A0303);
        padding: 50px;

        #lang {
            width: 50px;
            position: absolute;
            top: 10px;
            right: 10px;

            .icon {
                width: 40%;
                display: inline-block;
            }

            .icon:hover {
                cursor: pointer;
            }
        }
    }

    .inner {
        background-image: linear-gradient(to bottom right, #8A1D1D, #590909);
        box-shadow: 0 0 5px 0 black;
        padding: 30px;
    }

    .page {
        margin: 0 100px;
        background-image: linear-gradient(to bottom right, #E79752, #CC772D);
        box-shadow: 0 0 5px 0 black;
        padding: 20px;
    }
</style>

<style lang="scss">
    .page {
        .theme-heading {
            @font-face {
                font-family: main;
                src: url('/fonts/main.ttf');
            }

            font-family: main, sans-serif;
            text-align: center;
            margin: 20px auto;
        }
    }
</style>

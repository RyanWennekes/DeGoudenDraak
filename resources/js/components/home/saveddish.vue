<template>
    <input type="checkbox" v-model="checked"/>
</template>

<script>
    export default {
        name: "saveddish",
        props: ['dish'],
        computed: {
            checked: {
                get: function() {
                    return this.fetchSavedDishes().includes(this.$props.dish.id.toString());
                },
                set: function() {
                    let d = new Date();
                    d.setTime(d.getTime() + (365*24*60*60*1000));
                    let expires = "expires=" + d.toUTCString();

                    let dishes = this.fetchSavedDishes();

                    if(!dishes.includes(this.$props.dish.id.toString())) {
                        dishes.push(this.$props.dish.id);
                    } else {
                        for(let i = 0; i < dishes.length; i++) {
                            if(dishes[i] === this.$props.dish.id.toString()) {
                                dishes.splice(i);
                                break;
                            }
                        }
                    }

                    document.cookie = "saveddishes=" + dishes + ";" + expires + ";path=/";
                }
            }
        },
        methods: {
            fetchSavedDishes() {
                let decodedCookie = decodeURIComponent(document.cookie);
                let cookies = decodedCookie.split(';');
                let dishes = [];

                for(let i = 0; i < cookies.length; i++) {
                    while (cookies[i].charAt(0) === ' ') {
                        cookies[i] = cookies[i].substring(1);
                    }

                    if(cookies[i].includes('saveddishes')) {
                        dishes = cookies[i].substring(12).split(',');
                    }
                }

                return dishes;
            }
        }
    }
</script>

<style scoped>

</style>

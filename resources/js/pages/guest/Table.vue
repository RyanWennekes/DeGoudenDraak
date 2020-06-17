<template>
    <div>
        <ul>
            <li v-for="category in categories" @click.prevent="toggle(category)">
                {{ category.type_nl }}
                <table v-show="category.show">
                    <tr>
                        <th>Naam</th>
                        <th>Pittigheid</th>
                        <th>Allergenen</th>
                        <th>Hoeveelheid</th>
                    </tr>
                    <tr v-for="product in category.products">
                        <td>{{ product.name }}</td>
                        <td>{{ product.spiciness }}</td>
                        <td>-</td>
                        <td>
                            <counter :count="product.count"></counter>
                        </td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
</template>

<script>
    import {retrieveByCategory} from "../../api/home/products";
    import counter from "../../components/home/counter";

    export default {
        name: "Table",
        components: {
            counter
        },
        data() {
            return {
                categories: []
            }
        },
        created() {
            this.categories = this.getProductsByCategory();
        },
        methods: {
            async getProductsByCategory() {
                this.categories = await retrieveByCategory();
                this.categories.forEach(function(category) {
                    category.show = false;
                });
                this.forEachProduct(product => function(product) {
                    product.count = 0;
                });
            },
            toggle(category) {
                category.show = !category.show;
                this.$forceUpdate();
            },
            forEachProduct(callback) {
                this.categories.forEach(function(category) {
                    category.products.forEach(function(product) {
                        callback(product);
                    });
                });
            }
        }
    }
</script>

<style scoped>
    li:hover {
        cursor: pointer;
    }
</style>

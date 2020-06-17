<template>
    <div>
        <h1>Bestellen</h1>
        <ul class="categories">
            <li v-for="category in categories" @click.self="toggle(category)">
                {{ category.type_nl }}
                <table v-show="category.show" class="products">
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

<style lang="scss" scoped>
    h1 {
        text-align: center;
    }
    ul.categories {
        list-style-type: none;
        padding: 0;
        text-align: center;
    }
    li:hover {
        cursor: pointer;
    }

    table.products {
        border-spacing: 20px;
        width: 1000px;
        margin: 0 auto;
        text-align: right;

        td:first-child, th:first-child {
            text-align: left;
        }
    }
</style>

<template>
    <div>
        <div id="lang">
            <img src="/pictures/home/nl.svg" class="icon" @click="selectLocale('nl', $i18n)">
            <img src="/pictures/home/en.svg" class="icon" @click="selectLocale('en', $i18n)">
        </div>
        <modal :text="$t('table.help', {table: tableNo})" ref="Modal"></modal>
        <basket class="basket" :total="total()" :order="storeOrder" :help="help" :tableNo="tableNo" @changeTables="changeTables"></basket>
        <h1>{{ $t('table.title') }}</h1>
        <ul class="categories">
            <li v-for="category in categories" @click.self="toggle(category)">
                {{ lang(category.type_nl, category.type_en) }}
                <table v-show="category.show" class="products">
                    <tr>
                        <th>{{ $t('table.product.name') }}</th>
                        <th>{{ $t('table.product.spiciness') }}</th>
                        <th>{{ $t('table.product.allergenes') }}</th>
                        <th>{{ $t('table.product.amount') }}</th>
                    </tr>
                    <tr v-for="product in category.products">
                        <td>{{ product.name }}</td>
                        <td>{{ product.spiciness }}</td>
                        <td><span v-for="allergene in product.allergenes">{{$t('table.contains') + " " + allergene.allergene.name_en}}</span></td>
                        <td>
                            <counter :count="product.count" @incr="increment(product)" @decr="decrement(product)"></counter>
                        </td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
</template>

<script>
    import {retrieveByCategory} from "../../api/home/products";
    import {createGuestOrder} from "../../api/orders";
    import {requestHelp} from "../../api/tables";
    import counter from "../../components/home/counter";
    import basket from "../../components/guest/basket";
    import modal from "../../components/home/modal";

    export default {
        name: "Table",
        components: {
            counter,
            basket,
            modal
        },
        data() {
            return {
                categories: [],
                tableNo: 1,
            }
        },
        created() {
            this.categories = this.getProductsByCategory();
            this.$forceUpdate();
        },
        methods: {
            async getProductsByCategory() {
                this.categories = await retrieveByCategory();
                this.categories.forEach(function(category) {
                    category.show = false;
                });
                this.forEachProduct(product => {
                    product.count = 0;
                });
            },
            storeOrder() {
                let order = {
                    table_id: this.tableNo,
                    products: []
                };

                this.forEachProduct(product => {
                    product.count && order.products.push(product);
                });

                createGuestOrder(order);
            },
            help() {
                requestHelp(this.tableNo).then(r => {
                    this.$refs.Modal.show();
                });
            },
            toggle(category) {
                category.show = !category.show;
                this.$forceUpdate();
            },
            forEachProduct(callback) {
                if(!Array.isArray(this.categories)) {
                    return;
                }

                this.categories.forEach(function(category) {
                    category.products.forEach(function(product) {
                        callback(product);
                    });
                });
            },
            increment: function(product) {
                product.count++;
                this.$forceUpdate();
            },
            decrement: function(product) {
                product.count > 0 && product.count--;
                this.$forceUpdate();
            },
            total: function() {
                let price = 0;

                this.forEachProduct(product => {
                    if(product.count) {
                        price += (product.price * product.count);
                    }
                });

                return price.toFixed(2);
            },
            changeTables(tableNumber) {
                this.tableNo = tableNumber;
            },
            lang(nl, en) {
                return (this.$i18n.locale === 'en') ? en : nl;
            },
            selectLocale(locale, instance) {
                instance.locale = locale;
            }
        }
    }
</script>

<style lang="scss" scoped>
    #lang {
        width: 50px;
        position: absolute;
        top: 10px;
        left: 10px;

        .icon {
            width: 40%;
            display: inline-block;
        }

        .icon:hover {
            cursor: pointer;
        }
    }

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

    .basket {
        position: absolute;
        top: 20px;
        right: 20px;
    }
</style>

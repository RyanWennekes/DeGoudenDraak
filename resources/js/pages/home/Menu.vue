<template>
    <div class="wrapper">
        <div class="qr" v-if="showQR">
            <i class="fa fa-times" @click="showQR = false"></i>
            <div class="image-wrapper">
                <img :src="QRLink">
            </div>
            <p v-html="$t('menu.thankyou', {order: this.order, date: this.estimatePreparation()})"></p>
        </div>
        <div class="buttons">
            <theme-button id="printPDF" :action="downloadPDF">
                {{ $t('menu.pdf') }}
            </theme-button>
            <p>{{ $t('menu.total') + ": " + (this.total) }}</p>
            <theme-button id="printPDF" :action="orderBasket">
                {{ $t('menu.order') }} <i class="fas fa-shopping-basket"></i>
            </theme-button>
        </div>
        <div class="menu">
        <h1 class="theme-heading">{{ $t('menu.title') }}</h1>
        <div v-for="category in categories" class="menu">
            <h2 class="theme-heading">{{ lang(category.type_nl, category.type_en, $i18n) }}</h2>
            <table>
                <tr v-for="product in category.products">
                    <td v-text="product.code" class="code"></td>
                    <td v-text="product.name" class="name"></td>
                    <td class="price"><span v-if="hasDiscount(product)">{{ $t('menu.sale') }}</span>{{ discount(product) | currency}}</td>
                    <td class="counter"><counter :count="product.count" @incr="increment(product)" @decr="decrement(product)"></counter></td>
                    <td class="remember"><saveddish :dish="product"></saveddish></td>
                </tr>
            </table>
        </div>

        </div>
    </div>
</template>

<script>
    import {retrieveByCategory, generatePDF, order} from "../../api/home/products";
    import saveddish from "../../components/home/saveddish";
    import counter from "../../components/home/counter";

    export default {
        components: {
            saveddish,
            counter
        },
        name: "Menu",
        data() {
            return {
                categories: [],
                showQR: false,
                QRLink: '',
                order: 0
            }
        },
        mounted() {
            let fa = document.createElement('script');
            fa.setAttribute('src', 'https://kit.fontawesome.com/8c170b6078.js');
            fa.setAttribute('crossorigin', 'anonymous');
            document.head.appendChild(fa);
        },
        created() {
            this.getProductsByCategory();
        },
        computed: {
            total: function() {
                let price = 0;

                this.categories.forEach(function(element) {
                    element.products.forEach(function(element) {
                        if(element.count) {
                            let productPrice = element.price;
                            if(element.offers) {
                                element.offers.forEach(function(element) {
                                   productPrice *= ((100 - element.discount) / 100);
                                });
                            }

                            price += (productPrice * element.count);
                        }
                    });
                });

                this.forEachProduct(product => function(product) {
                    if(product.count) {
                        let productPrice = product.price;
                        if(product.offers) {
                            product.offers.forEach(function(element) {
                                productPrice *= ((100 - element.discount) / 100);
                            });
                        }

                        price += (productPrice * product.count);
                    }
                });

                return price;
            }
        },
        methods: {
            async getProductsByCategory() {
                this.categories = await retrieveByCategory();

                this.forEachProduct(product => function(product) {
                    product.count = 0;
                });
            },
            discount(product) {
                if(product.offers.length) {
                    let price = parseFloat(product.price);

                    for(let i = 0; i < product.offers.length; i++) {
                        price = ((100 - product.offers[i].discount) / 100) * price;
                    }

                    return price;
                }

                return parseFloat(product.price);
            },
            hasDiscount(product) {
                return this.discount(product) !== parseFloat(product.price);
            },
            lang(nl, en, instance) {
                return (instance.locale === 'en') ? en : nl;
            },
            downloadPDF() {
                generatePDF(this.$i18n.locale).then(r => this.showFile(r));
            },
            showFile(data) {
                let newBlob = new Blob([data], {type: "application/pdf"})

                if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                    window.navigator.msSaveOrOpenBlob(newBlob);
                    return;
                }

                const download = window.URL.createObjectURL(newBlob);

                let link = document.createElement('a');
                link.href = download;
                link.download="menu.pdf";
                link.click();
                setTimeout(function(){
                    window.URL.revokeObjectURL(download);
                }, 100);
            },
            orderBasket() {
                let basket = [];
                this.forEachProduct(product => function(product) {
                    if(product.count) {
                        basket.push(product);
                    }
                });

                basket.length && order(basket).then(r => {
                    this.QRLink = "data:image/png;base64, " + r.data.code;
                    this.showQR = true;
                    this.order = r.data.order;
                }).catch(e => function(e) {
                    console.log(e);
                });
            },
            hideModal() {
                this.showQR = false;
            },
            increment: function(product) {
                product.count++;
                this.$forceUpdate();
            },
            decrement: function(product) {
                product.count--;
                this.$forceUpdate();
            },
            estimatePreparation() {
                let date = new Date();
                date.setTime(date.getTime() + (30*60*1000));

                return date.getHours() + ":" + ((date.getMinutes() < 10) ? '0' : '') + date.getMinutes();
            },
            forEachProduct(callback) {
                this.categories.forEach(function(category) {
                    category.products.forEach(function(product) {
                        callback(product);
                    });
                });
            }
        },
    }
</script>

<style lang="scss">

</style>


<style lang="scss" scoped>

    div.qr {
        position: fixed;
        display: flex;
        flex-wrap: wrap;
        background: rgba(0, 0, 0, 0.8);
        width: 100%;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        justify-content: center;
        align-items: center;
        z-index: 999;

        .image-wrapper {
            display: flex;
            justify-content: center;
        }

        .image-wrapper, p {
            flex: 0 1 100%;
        }

        i {
            color: white;
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 50px;
        }

        i:hover {
            cursor: pointer;
        }

        p {
            color: white;
            font-size: 30px;
            text-align: center;
        }
    }

    div.wrapper {
        position: relative;
    }

    .buttons {
        position: absolute;
        right: 0;
    }

    div.menu {
        width: 700px;
        margin: 0 auto;

        table {
            border-spacing: 10px;
            table-layout: fixed;
            width: 100%;

            td.code {
                width: 30px;
            }

            td.counter {
                width: 100px;
                text-align: center;
            }

            td.name {
            }

            td.price {
                text-align: right;

                span {
                    background: red;
                    color: white;
                    padding: 5px 10px;
                    font-weight: bold;
                    border-radius: 15px;
                    margin-right: 10px;
                    box-shadow: 0 0 5px 0 black;
                }
            }

            td.remember {
                width: 30px;
            }
        }
    }

</style>

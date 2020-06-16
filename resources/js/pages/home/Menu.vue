<template>
    <div class="wrapper">
        <div class="buttons">
            <theme-button id="printPDF" :action="downloadPDF">
                {{ $t('menu.pdf') }}
            </theme-button>
            <theme-button id="printPDF" :action="order">
                {{ $t('menu.order') }}
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
                    <td class="counter"><counter :product="product"></counter></td>


<!--                    <td class="small"><remove-dish :dish="product"></remove-dish></td>-->
<!--                    <td class="small"><input type="number" v-model="product.count" @increment="increment" @decrement="decrement"></td>-->
<!--                    <td class="small"><add-dish :dish="product"></add-dish></td>-->
                    <td class="remember"><saveddish :dish="product"></saveddish></td>
                </tr>
            </table>
        </div>

        </div>
    </div>
</template>

<script>
    import {retrieveByCategory, generatePDF} from "../../api/home/products";
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
                categories: []
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
        methods: {
            async getProductsByCategory() {
                this.categories = await retrieveByCategory();

                for(let i = 0; i < this.categories.length; i++) {
                    for(let j = 0; j < this.categories[i].products.length; j++) {
                        this.categories[i].products[j].count = 0;
                    }
                }
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

                const d = window.URL.createObjectURL(newBlob);

                let link = document.createElement('a');
                link.href = d;
                link.download="menu.pdf";
                link.click();
                setTimeout(function(){
                    window.URL.revokeObjectURL(d);
                }, 100);
            },
            order() {
                
            }
        }
    }
</script>

<style lang="scss" scoped>

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

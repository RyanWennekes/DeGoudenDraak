<template>
    <div class="wrapper">
        <theme-button id="printPDF" :action="downloadPDF">
            {{ $t('menu.pdf') }}
        </theme-button>
        <div class="menu">
        <h1 class="theme-heading">{{ $t('menu.title') }}</h1>
        <div v-for="category in categories" class="menu">
            <h2 class="theme-heading">{{ lang(category.type_nl, category.type_en, $i18n) }}</h2>
            <table>
                <tr v-for="product in category.products">
                    <td v-text="product.code" class="code"></td>
                    <td v-text="product.name" class="name"></td>
                    <td class="price"><span v-if="hasDiscount(product)">{{ $t('menu.sale') }}</span>{{ discount(product) | currency}}</td>
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

    export default {
        components: {
            saveddish
        },
        name: "Menu",
        data() {
            return {
                categories: []
            }
        },
        created() {
            this.getProductsByCategory();
        },
        methods: {
            async getProductsByCategory() {
                this.categories = await retrieveByCategory();
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
                generatePDF().then(r => this.showFile(r));
            },
            showFile(data) {
                console.log(data);
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
            }
        }
    }
</script>

<style lang="scss" scoped>

    div.wrapper {
        position: relative;
    }

    #printPDF {
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

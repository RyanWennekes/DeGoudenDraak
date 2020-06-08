<template>
    <v-chip :color="color" class="white--text" v-show="hasSpiciness">{{text}}</v-chip>
</template>

<script>
import {ProductSpicinessText, ProductSpicinessColor, ProductSpiciness} from '../../enums/Product.js';

export default {
    name: 'ChipSpiciness',
    props: {
        spiciness: {
            type: Number,
            default: null,
        },
    },
    computed: {
        color() {
            return ProductSpicinessColor[this.spiciness];
        },
        text() {
            return ProductSpicinessText[this.spiciness];
        },
        hasSpiciness() {
            return this.spiciness != null && this.spiciness !== ProductSpiciness.NONE;
        },
    },
};
</script>

const ProductSpiciness = {
    NONE: 0,
    MEDIUM: 1,
    HOT: 2,
    EXTREME: 3,
};

const ProductSpicinessText = {
    [ProductSpiciness.NONE]: 'Geen',
    [ProductSpiciness.MEDIUM]: 'Warm',
    [ProductSpiciness.HOT]: 'Heet',
    [ProductSpiciness.EXTREME]: 'Extra heet',
};

const ProductSpicinessColor = {
    [ProductSpiciness.NONE]: 'grey',
    [ProductSpiciness.MEDIUM]: 'yellow darken-2',
    [ProductSpiciness.HOT]: 'orange',
    [ProductSpiciness.EXTREME]: 'red',
};

const ProductSpicinessIcon = {
    [ProductSpiciness.NONE]: 'fa-circle',
    [ProductSpiciness.MEDIUM]: 'fa-tint-slash',
    [ProductSpiciness.HOT]: 'fa-fire',
    [ProductSpiciness.EXTREME]: 'fa-pepper-hot',
};

export {ProductSpiciness, ProductSpicinessText, ProductSpicinessColor, ProductSpicinessIcon};

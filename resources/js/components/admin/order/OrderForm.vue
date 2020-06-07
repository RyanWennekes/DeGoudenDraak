<template>
    <div>
        <h2 class="mb-3 text-center">Bestelling</h2>
        <VDivider/>

        <v-simple-table height="500px">
            <template #default>
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-left">Naam</th>
                        <th class="text-center">Aantal</th>
                        <th class="actions"></th>
                        <th class="text-left"></th>
                        <th class="center">Prijs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in value" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td class="text-center">{{ item.total }}x</td>
                        <td class="pa-0">
                            <v-btn icon color="blue" @click="$emit('addProduct', item)">
                                <v-icon>fa-plus</v-icon>
                            </v-btn>
                            <v-btn icon color="blue" @click="$emit('removeProduct', item)">
                                <v-icon>fa-minus</v-icon>
                            </v-btn>
                        </td>
                        <td class="text-center">{{ item.price | currency}}</td>
                        <td class="text-center">{{ (item.price * item.total) | currency}}</td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
    </div>
</template>

<script>
export default {
    name: 'OrderForm',
    props: ['value'],
};
</script>

<style lang="scss">
.actions {
    min-width: 76px;
}
</style>

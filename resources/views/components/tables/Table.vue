<script setup>
defineProps({
    data: {
        type: Array,
        required: true,
    },
    columns: {
        type: Array,
        required: true,
    },
    header: String,
});
</script>

<template>
    <h3>{{ header }}</h3>
    <table class="custom-table">
        <thead>
            <tr>
                <th v-for="column in columns" :key="column.key">
                    {{ column.label }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in data" :key="index">
                <td v-for="column in columns" :key="column.key">
                    <slot
                        :name="column.key"
                        :row="row"
                        :value="row[column.key]"
                    >
                        {{ row[column.key] }}
                    </slot>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
.custom-table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

.custom-table th,
.custom-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.custom-table th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.custom-table tr:nth-child(even) {
    background-color: #f9f9f9;
}
</style>

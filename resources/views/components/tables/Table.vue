<script setup>
defineProps({
    data: Array,
    columns: Array,
    header: String,
});
</script>

<template>
    <h3>{{ header }}</h3>
    <table class="table">
        <thead>
            <tr>
                <th v-for="{ key, label } in columns" :key="key">
                    {{ label }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(row, index) in data" :key="index">
                <td v-for="{ key } in columns" :key="key">
                    <div v-if="key === 'actions'" class="table-actions">
                        <slot name="actions" :row="row" />
                    </div>
                    <slot v-else :name="key" :row="row" :value="row[key]">
                        {{ row[key] }}
                    </slot>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
.table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

.table th,
.table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.table th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}
</style>

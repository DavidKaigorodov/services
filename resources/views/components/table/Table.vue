<script setup>
defineProps({
    data: Array,
    columns: Array,
    header: String,
});
</script>

<template>
    <div class="table-container">
        <h3 class="table-header">{{ header }}</h3>
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
    </div>
</template>

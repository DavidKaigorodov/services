<script setup>
import { usePage } from "@inertiajs/vue3";
import TabItem from "./TabItem.vue";

const props = defineProps({
    tabs: {
        type: Array,
        required: true,
    },
    params: Object,
});
</script>

<template>
    <nav class="tab-bar">
        <ul class="tab-list">
            <TabItem
                v-for="tab in tabs"
                :key="tab.href"
                :href="tab.href"
                :label="tab.title"
                :active="route().current(tab.href)"
                :params="props.params"
            />
        </ul>

        <TabItem
            v-if="['division_worker', 'division_admin'].includes(usePage().props.current_user.data.role.code)"
            method="post"
            name="tab-logout"
            key="logout"
            href="logout"
            label="Выход"
        />
    </nav>
</template>

<style lang="sass" scoped>
.tab-bar
    background: #f8f9fa
    border-bottom: 1px solid #ddd
    padding: 0 16px
    display: flex
    justify-content: space-between
    align-items: center

    .tab-list
        display: flex
        list-style: none
        margin: 0
        padding: 0
        gap: 4px
        align-items: flex-end

    .tab-logout
        cursor: pointer
</style>

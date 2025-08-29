<script setup>
import { default as Tab } from "../../components/tab/Tab.vue";

const attrs = defineProps({
    division_id: Number,
});
</script>
<template>
    <Tab
        :tabs="[
            { href: 'divisions.show', title: 'Общая информаця' },
            { href: 'division-admins.index', title: 'Адмистраторы' },
            { href: 'workers.index', title: 'Сотрудники' },
            { href: 'events.index', title: 'Календарь событий' },
            { href: 'subscribes.index', title: 'Обращения' },
        ]"
        :params="{ division: attrs.division_id }"
    />
    <slot />
</template>

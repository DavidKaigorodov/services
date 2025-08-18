<script setup>
import { Tab } from "@components";
import { usePage } from "@inertiajs/vue3";
const user = usePage().props.current_user.data;
</script>
<template>
  <Tab
    :tabs="[
      { href: 'divisions.show', title: 'Общая информаця' },
      { href: 'division-admins.index', title: 'Адмистраторы' },
      { href: 'workers.index', title: 'Сотрудники' },
    ]"
    :params="{ division: user.division_id }"
  />
  <slot />
</template>

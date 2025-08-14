<script setup>
import { Tab } from "@components";
</script>
<template>
  <Tab
    :tabs="[
      { href: 'divisions.create', title: 'Общая информаця' },
      { href: 'divisions.index', title: 'Адмистраторы' },
      { href: 'dashboard.index', title: 'Сотрудники' },
    ]"
  />
  <slot />
</template>

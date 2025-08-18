<script setup>
import { ItemMenu } from "@includes";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props.current_user.data;
</script>

<template>
  <nav class="sidebar">
    <div class="sidebar-header">
      <h3>Навигационная панель</h3>
    </div>

    <ul class="sidebar-menu">
      <h4>Админ панель</h4>
      <ItemMenu class="sidebar-link" href="divisions.index" label="Подразделения" />
      <ItemMenu class="sidebar-link" href="cities.index" label="Города" />
      <h4>Подразделения панель</h4>
      <ItemMenu class="sidebar-link" href="service.index" label="Услуги" />
      <ItemMenu
        :params="{ division: user.division_id }"
        class="sidebar-link"
        href="divisions.show"
        label="Общая информация"
      />
      <ItemMenu class="sidebar-link" href="subscribes.index" label="Специалист" />
      <ItemMenu class="sidebar-link" href="dashboard.index" label="Календарь событий" />
    </ul>
  </nav>
</template>

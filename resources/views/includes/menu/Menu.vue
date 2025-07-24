<script setup>
import ItemMenu from "./ItemMenu.vue";
</script>

<template>
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Навигационная панель</h3>
        </div>

        <ul class="sidebar-menu">
            <ItemMenu class="sidebar-link" href="/" label="Домой" />
            <ItemMenu class="sidebar-link" href="/" label="Домой" />
        </ul>
    </nav>
</template>

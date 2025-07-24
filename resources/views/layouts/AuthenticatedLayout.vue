<script setup>
import BaseLayout from "./BaseLayout.vue";
import Menu from "../includes/menu/Menu.vue";
</script>
<template>
    <BaseLayout name="authenticated-layout">
        <Menu />
        <main class="main-content">
            <slot />
        </main>
    </BaseLayout>
</template>

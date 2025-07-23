<script setup>
import BaseLayout from "./BaseLayout.vue";
</script>
<template>
    <BaseLayout name="authenticated-layout">
        <main>
            <slot />
        </main>
    </BaseLayout>
</template>

<script setup>
import BaseFrom from "./BaseForm.vue";
</script>

<template>
    <BaseFrom :header="''" className="horizontal-form">
        <slot />
    </BaseFrom>
</template>

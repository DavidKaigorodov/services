<script setup>
import BaseFrom from "./BaseForm.vue";
</script>

<template>
    <BaseFrom :header="'123'" className="horizontal-form">
        <slot />
    </BaseFrom>
</template>

<script setup>
import BaseFrom from "./BaseForm.vue";
</script>

<template>
    <BaseFrom :header="'123'" className="vertical-form">
        <slot />
    </BaseFrom>
</template>

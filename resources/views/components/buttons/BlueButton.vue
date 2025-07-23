<script setup>
import BaseButton from "./BaseButton.vue";
</script>

<template>
    <BaseButton className="blue-button" v-bind="$attrs">
        <slot />
    </BaseButton>
</template>

<script setup>
import BaseButton from "./BaseButton.vue";
</script>

<template>
    <BaseButton className="red-button" v-bind="$attrs">
        <slot />
    </BaseButton>
</template>

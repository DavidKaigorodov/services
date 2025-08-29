<script setup>
import { default as FlashMessage } from "../includes/FlashMessage.vue";

const props = defineProps({
    name: String,
});
</script>

<template>
    <div :class="['layout', name]">
        <FlashMessage />
        <slot />
    </div>
</template>

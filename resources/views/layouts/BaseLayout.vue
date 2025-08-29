<script setup>
import { FlashMessage } from "@includes";

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

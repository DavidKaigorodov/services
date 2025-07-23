<script setup>
const props = defineProps({
    name: String,
});
</script>

<template>
    <div :class="['layout', name]">
        <slot />
    </div>
</template>

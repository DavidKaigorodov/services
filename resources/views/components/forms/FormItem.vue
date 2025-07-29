<script setup>
const props = defineProps({
    name: String,
});
</script>
<template>
    <div :class="['form-item', name]">
        <slot />
    </div>
</template>

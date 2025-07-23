<script setup>
const props = defineProps({
    name: String,
});
</script>
<template>
    <div :class="['form-group', name]">
        <slot />
    </div>
</template>

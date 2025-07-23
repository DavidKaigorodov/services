<script setup>
const props = defineProps({
    name: String,
    labelText: String,
});
</script>

<template>
    <label :htmlFor="name">
        {{ labelText }}
    </label>
</template>

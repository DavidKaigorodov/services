<script setup>
const props = defineProps({
    name: String,
    labelText: String,
});
</script>

<template>
    <label :htmlFor="name" class="label">
        {{ labelText }}
    </label>
</template>

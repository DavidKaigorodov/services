<script setup>
import Label from "./Label.vue";

const props = defineProps({
    name: String,
    label: String,
});
</script>

<template>
    <Label :name="name" :labelText="label" />
    <div :class="['form-group', name]">
        <slot />
    </div>
</template>

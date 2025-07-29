<script setup>
import Label from "./Label.vue";

const props = defineProps({
    name: String,
    label: String,
});
</script>

<template>
    <div class="form-group-container">
        <Label name="group" :labelText="label"/>
        <div :class="['form-group', name]">
            <slot />
        </div>
    </div>
</template>

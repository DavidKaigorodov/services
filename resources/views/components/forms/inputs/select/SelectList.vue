<script setup>
defineProps({
    options: {
        type: Array,
        required: true,
    },
    modelValue: [String, Number],
    onSelect: Function,
});
</script>

<template>
    <ul class="select-dropdown">
        <li
            v-for="option in options"
            :key="option.value"
            class="select-option"
            :class="{ 'is-selected': option.value === modelValue }"
            @click.stop="onSelect(option)"
        >
            {{ option.label }}
        </li>
    </ul>
</template>

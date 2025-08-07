<script setup>
defineProps({
    selectedLabel: String,
    placeholder: String,
    isOpen: Boolean,
    disabled: Boolean,
});
</script>

<template>
    <div
        class="select-input"
        :class="{ 'is-open': isOpen, 'is-disabled': disabled }"
    >
        <span class="select-value">
            {{ selectedLabel || placeholder }}
        </span>
        <div class="select-arrow" />
    </div>
</template>

<script setup>
import { default as CheckMarkIco } from "../icons/CheckMarkIco.vue";

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
        default: "",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const toggle = () => {
    if (props.disabled) return;
    emit("update:modelValue", !props.modelValue);
};
</script>

<template>
    <label
        class="custom-checkbox"
        :class="{ disabled: props.disabled }"
        @click="toggle"
    >
        <span class="checkbox-box">
            <CheckMarkIco v-if="props.modelValue" />
        </span>
        <span class="checkbox-label" v-if="props.label">{{ props.label }}</span>
    </label>
</template>

<style lang="sass">
@use '../../../sass/abstracts' as *

.custom-checkbox
    display: flex
    align-items: center
    user-select: none
    gap: 8px

    &.disabled
        cursor: not-allowed
        opacity: 0.6

.checkbox-box
    width: 20px
    height: 20px
    border: 1px solid var(--input-border-color)
    border-radius: 7px
    background: var(--input-background)
    display: flex
    align-items: center
    justify-content: center
    transition: all 0.2s
    cursor: pointer

    svg

        stroke: var(--text-color)

.checkbox-label
    font-size: 0.95rem
    color: var(--text-color)
</style>

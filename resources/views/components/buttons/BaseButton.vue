<script setup>
const props = defineProps({
    type: {
        type: String,
        default: "button",
    },
    className: String,
    disabled: Boolean,
    handleClick: Function,
});
</script>

<template>
    <button
        :type="type"
        :class="'button' + (className ? ' ' + className : '')"
        :disabled="disabled"
        @click="handleClick"
        v-bind="$attrs"
    >
        <slot />
    </button>
</template>

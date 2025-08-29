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

<style lang="sass">
@use '../../../sass/abstracts' as *

button, .button
    min-height: 30px
    padding: 5px 15px

    border: none
    border-radius: 7px

    color: white
    font-weight: bold
    font-size: .95rem
    line-height: 1rem

    cursor: pointer
    transition: .5s
@include button-disabled
</style>

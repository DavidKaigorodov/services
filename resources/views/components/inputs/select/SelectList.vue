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
    <div class="select-dropdown">
        <ul>
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
    </div>
</template>

<style lang="sass" scoped>
@use '../../../../sass/abstracts' as *

.select-dropdown
    position: absolute
    top: 100%
    left: 0
    right: 0
    background: var(--input-background)
    border: 1px solid var(--input-border-color)
    border-top: none
    border-radius: 0 0 7px 7px
    overflow: hidden
    z-index: 1000
    animation: slideDown 0.2s ease

    ul
        overflow-y: auto
        max-height: 200px
        @include scroll

        .select-option
            font-size: 0.95rem
            padding: 10px 10px
            cursor: pointer

            &:last-child
                border-bottom: none
            &:hover
                background: #83adf028

@keyframes slideDown
    from
        opacity: 0
        transform: translateY(-10px)
    to
        opacity: 1
        transform: translateY(0)
</style>

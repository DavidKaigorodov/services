<script setup>
import { CalendarIco } from "@components";

const props = defineProps({
    modelValue: String,
    disabled: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["toggle"]);
</script>

<template>
    <div
        class="input datepicker-input"
        :class="{ disabled: props.disabled }"
        @click="!props.disabled && $emit('toggle')"
    >
        <span class="input-text">{{ modelValue }}</span>
        <div class="ico-calendar">
            <CalendarIco />
        </div>
        <input
            type="hidden"
            :value="modelValue"
            v-bind="$attrs"
            :disabled="props.disabled"
        />
    </div>
</template>

<style lang="sass" scoped>
.datepicker-input
    display: flex
    cursor: pointer
    min-width: 280px
    justify-content: space-between
    .input-text
        flex: 1
        text-align: start
        white-space: nowrap
        overflow: hidden
        text-overflow: ellipsis
    .ico-calendar
        flex-shrink: 0
        margin-left: 8px
        display: flex
        align-items: center
        color: #aaa
    &.disabled
        opacity: 0.6
        cursor: not-allowed
        pointer-events: none
</style>

<script>
import CalendarIco from "../../icons/CalendarIco.vue";

export default {
    components: {
        CalendarIco,
    },

    props: {
        modelValue: {
            type: [String, Object, Number],
            default: null,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },

    emits: ["toggle"],

    methods: {
        handleClick() {
            if (!this.disabled) {
                this.$emit("toggle");
            }
        },
    },
};
</script>

<template>
    <div
        class="input datepicker-input"
        :class="{ disabled: disabled }"
        @click="handleClick"
    >
        <span class="input-text">{{ modelValue }}</span>
        <div class="ico-calendar">
            <CalendarIco />
        </div>
        <input
            type="hidden"
            :value="modelValue"
            v-bind="$attrs"
            :disabled="disabled"
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

<script>
export default {
    props: {
        modelValue: {
            type: [String, Object, Number],
            default: null,
        },
    },

    emits: ["update:modelValue", "close"],

    data() {
        return {
            tempHour: null,
            tempMinute: null,
            userSelectedHour: false,
            userSelectedMinute: false,
            hours: Array.from({ length: 24 }, (_, i) => i),
            minutes: Array.from({ length: 60 }, (_, i) => i),
        };
    },

    watch: {
        modelValue: {
            handler(val) {
                if (val && typeof val === "string") {
                    const [h, m] = val.split(":");
                    this.tempHour = parseInt(h);
                    this.tempMinute = parseInt(m);
                } else {
                    this.tempHour = null;
                    this.tempMinute = null;
                }
                this.userSelectedHour = false;
                this.userSelectedMinute = false;
            },
            immediate: true,
        },
    },

    methods: {
        pad(n) {
            return String(n).padStart(2, "0");
        },
        updateValue() {
            if (this.tempHour !== null && this.tempMinute !== null) {
                this.$emit(
                    "update:modelValue",
                    `${this.pad(this.tempHour)}:${this.pad(this.tempMinute)}`,
                );
            }
        },
        selectHour(hour) {
            this.tempHour = hour;
            this.userSelectedHour = true;
            this.updateValue();
            this.tryEmit();
        },
        selectMinute(minute) {
            this.tempMinute = minute;
            this.userSelectedMinute = true;
            this.updateValue();
            this.tryEmit();
        },
        tryEmit() {
            if (this.userSelectedHour && this.userSelectedMinute) {
                this.$emit("close");
            }
        },
    },
};
</script>

<template>
    <div class="timepicker-popup">
        <div class="timepicker-header">
            <span :class="{ selected: tempHour }">Часы</span>
            <span :class="{ selected: tempMinute }">Минуты</span>
        </div>

        <div class="timepicker-columns">
            <div class="timepicker-column hours">
                <div
                    v-for="h in hours"
                    :key="h"
                    class="timepicker-item"
                    :class="{ selected: h === tempHour }"
                    @click="selectHour(h)"
                >
                    {{ h }}
                </div>
            </div>

            <div class="timepicker-column minutes">
                <div
                    v-for="m in minutes"
                    :key="m"
                    class="timepicker-item"
                    :class="{ selected: m === tempMinute }"
                    @click="selectMinute(m)"
                >
                    {{ m }}
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="sass" scoped>
.timepicker-popup
    background: white
    border-radius: 0.5rem
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)
    border: 1px solid #e5e7eb
    position: absolute
    left: 0
    right: 0
    z-index: 1000
    margin-top: 8px
    width: 240px
    overflow: hidden

    .timepicker-header
        display: grid
        grid-template-columns: 1fr 1fr
        gap: 0.5rem
        padding: 0.75rem 0.5rem
        background-color: #f9fafb
        border-bottom: 1px solid #e5e7eb
        text-align: center
        font-size: 0.875rem
        font-weight: 600
        color: #6b7280
        letter-spacing: -0.01em

        span
            position: relative

            &::after
                content: ''
                position: absolute
                bottom: -1px
                left: 50%
                transform: translateX(-50%)
                width: 0
                height: 2px
                background-color: transparent
                transition: all 0.2s ease

            &.selected
                color: var(--blue-button-background-color)

            &::after
                width: 50%
                background-color: var(--blue-button-background-color)

    .timepicker-columns
        display: flex
        height: 200px
        border-bottom: 1px solid #e5e7eb

        .timepicker-column
            flex: 1
            overflow-y: auto
            padding: 0.25rem 0
            scroll-behavior: smooth

            &.hours
                border-right: 1px solid #e5e7eb

            .timepicker-item
                display: flex
                align-items: center
                justify-content: center
                height: 36px
                font-size: 0.9rem
                font-weight: 500
                color: #374151
                cursor: pointer
                border-radius: 0.5rem
                margin: 0 0.5rem
                transition: all 0.2s ease

                &:hover
                    background-color: var(--blue-button-background-color)
                    color: white

                &.selected
                    background-color: var(--blue-button-background-color-hover)
                    color: white
                    font-weight: 600
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1)
</style>

<script>
import dayjs from "dayjs";
import "dayjs/locale/ru";
import ChevronRigtIco from "../../icons/ChevronRightIco.vue";
import ChevronLeftIco from "../../icons/ChevronLeftIco.vue";
import { getMonthDays, isSameDay } from "./utils";

dayjs.locale("ru");

export default {
    components: {
        ChevronRigtIco,
        ChevronLeftIco,
    },
    props: {
        modelValue: {
            type: [String, Object, Number],
            default: null,
        },
    },
    emits: ["update:modelValue"],

    data() {
        return {
            currentMonth: dayjs(this.modelValue || new Date()),
            weekDays: ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
        };
    },

    computed: {
        normalizedValue() {
            if (!this.modelValue) return null;
            return dayjs(this.modelValue).format("YYYY-MM-DD");
        },
        days() {
            return getMonthDays(this.currentMonth);
        },
    },

    watch: {
        modelValue(newVal) {
            if (newVal) {
                this.currentMonth = dayjs(newVal);
            }
        },
    },

    methods: {
        formatDate(date, format = "YYYY-MM-DD") {
            return date ? dayjs(date).format(format) : "";
        },
        select(date) {
            if (!date) return;
            this.$emit("update:modelValue", this.formatDate(date));
        },
        prevMonth() {
            this.currentMonth = this.currentMonth.subtract(1, "month");
        },
        nextMonth() {
            this.currentMonth = this.currentMonth.add(1, "month");
        },
        isToday(date) {
            return date && isSameDay(date, new Date());
        },
        isSelected(date) {
            if (!date || !this.normalizedValue) return false;
            return this.formatDate(date) === this.normalizedValue;
        },
    },
};
</script>

<template>
    <div class="calendar-header">
        <div class="calendar-weekdays">
            <button @click="prevMonth">
                <ChevronLeftIco />
            </button>
            <span class="font-bold">
                {{ currentMonth.format("MMMM YYYY") }}
            </span>
            <button @click="nextMonth">
                <ChevronRigtIco />
            </button>
        </div>

        <div class="calendar-days">
            <span v-for="day in weekDays" :key="day">{{ day }}</span>
        </div>

        <div class="grid grid-cols-7 gap-1">
            <button
                v-for="(day, index) in days"
                :key="index"
                @click="select(day)"
                :disabled="!day"
                :class="[
                    'calendar-day',
                    isToday(day) ? 'today' : '',
                    isSelected(day) ? 'selected' : '',
                ]"
            >
                {{ day ? formatDate(day, "D") : "" }}
            </button>
        </div>
    </div>
</template>

<style lang="sass">
.calendar-header
    background: white
    border-radius: 0.5rem
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)
    border: 1px solid #e5e7eb
    position: absolute
    left: 0
    right: 0
    margin-top: 8px

    .calendar-weekdays
        display: flex
        align-items: center
        justify-content: space-between
        padding: 0.75rem 1rem
        background-color: #f9fafb
        font-size: 0.875rem
        font-weight: 600
        text-transform: uppercase
        letter-spacing: 0.05em
        color: #1f2937
        button
            background: none
            border: none
            font-size: 1.25rem
            cursor: pointer
            color: var(--blue-button-background-color)
            padding: 0

        &:hover
            color: #374151

    .calendar-days
        display: grid
        grid-template-columns: repeat(7, 1fr)
        gap: 0.25rem
        padding: 0.5rem
        background-color: #f9fafb
        border-bottom: 1px solid #e5e7eb
        font-size: 0.75rem
        font-weight: 500
        color: #6b7280
        text-align: center

    .grid.grid-cols-7
        display: grid
        grid-template-columns: repeat(7, 1fr)
        gap: 0.25rem
        padding: 0.5rem
        background: white

        .calendar-day
            height: 2.5rem
            display: flex
            align-items: center
            justify-content: center
            border-radius: 0.5rem
            font-size: 0.875rem
            color: #374151
            cursor: pointer
            transition: all 0.2s ease
            border: none
            background: transparent
            padding: 0

            &:hover:not(:disabled)
                background-color: #eff6ff
                color: var(--blue-button-background-color)
                font-weight: 500

            &.today
                border: 1px solid var(--blue-button-background-color)
                font-weight: 600

            &.selected
                background-color: var(--blue-button-background-color)
                color: white
                font-weight: 700
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1)

            &:disabled
                opacity: 0.4
                background: none
                cursor: default
            &:hover
                background: none
</style>

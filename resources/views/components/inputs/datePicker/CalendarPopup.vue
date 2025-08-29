<script setup>
import { ref, computed } from "vue";

import dayjs from "dayjs";
import "dayjs/locale/ru";

import { getMonthDays, isSameDay } from "./utils";

const props = defineProps({
    modelValue: String,
});

const emit = defineEmits(["update:modelValue"]);

dayjs.locale("ru");
const weekDays = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];

const currentMonth = ref(dayjs(props.modelValue || new Date()));

const days = computed(() => getMonthDays(currentMonth.value));

const select = (date) => {
    emit("update:modelValue", dayjs(date).format("YYYY-MM-DD"));
};

const prevMonth = () => {
    currentMonth.value = currentMonth.value.subtract(1, "month");
};

const nextMonth = () => {
    currentMonth.value = currentMonth.value.add(1, "month");
};

const isToday = (date) => date && isSameDay(date, new Date());
const isSelected = (date) =>
    date && dayjs(date).format("YYYY-MM-DD") === props.modelValue;
</script>

<template>
    <div class="calendar-header">
        <div class="calendar-weekdays">
            <button @click="prevMonth">‹</button>
            <span class="font-bold">
                {{ currentMonth.format("MMMM YYYY") }}s
            </span>
            <button @click="nextMonth">›</button>
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
                {{ day ? dayjs(day).date() : "" }}
            </button>
        </div>
    </div>
</template>
<style lang="sass" scoped>
.calendar-header
    background: whiteF
    border-radius: 0.5rem
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)
    border: 1px solid #e5e7eb
    position: absolute
    left: 0
    right: 0F
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
            transition: all 0.2s easeall 0.2s ease
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

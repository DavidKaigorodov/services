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
      <span class="font-bold">{{ currentMonth.format("MMMM YYYY") }}</span>
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

<script setup>
import { DatePicker } from "@components";

const props = defineProps({
  modelValue: {
    type: Object,
    required: true,
  },
  name: String,
  disabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:modelValue"]);

const updateDay = (day, key, value) => {
  emit("update:modelValue", {
    ...props.modelValue,
    [day]: {
      ...props.modelValue[day],
      [key]: value,
    },
  });
};

// Чекбокс теперь значит "рабочий день"
const toggleWorkDay = (day) => {
  const current = props.modelValue[day]?.is_off || false;
  updateDay(day, "is_off", current); // current = false значит рабочий день
  updateDay(day, "is_off", !current); // переключаем
};

const days = [
  { key: "mon", label: "Пн" },
  { key: "tue", label: "Вт" },
  { key: "wed", label: "Ср" },
  { key: "thu", label: "Чт" },
  { key: "fri", label: "Пт" },
  { key: "sat", label: "Сб" },
  { key: "sun", label: "Вс" },
];
</script>

<template>
  <div class="work-schedule-time">
    <div v-for="day in days" :key="day.key" class="day-row">
      <span class="day-label">{{ day.label }}:</span>

      <!-- Галочка "рабочий день" -->
      <label class="off-day">
        <input
          type="checkbox"
          :checked="!modelValue[day.key]?.is_off"
          @change="toggleWorkDay(day.key)"
          :disabled="disabled"
        />
      </label>

      <!-- Дата начала и конца показываем только если день рабочий -->
      <div class="time-picker-block" v-if="!modelValue[day.key]?.is_off">
        <DatePicker
          mode="time"
          :modelValue="modelValue[day.key]?.date_start"
          @update:modelValue="(val) => updateDay(day.key, 'date_start', val)"
          :name="`${name}[${day.key}][date_start]`"
          :disabled="disabled"
          :label="''"
        />
        <DatePicker
          mode="time"
          :modelValue="modelValue[day.key]?.date_end"
          @update:modelValue="(val) => updateDay(day.key, 'date_end', val)"
          :name="`${name}[${day.key}][date_end]`"
          :disabled="disabled"
          :label="''"
        />
        <span
          v-if="!modelValue[day.key]?.date_start || !modelValue[day.key]?.date_end"
          class="error"
        >
          Укажите время начала и конца
        </span>
      </div>
    </div>
  </div>
</template>

<style scoped>
.work-schedule-time {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.day-row {
  display: flex;
  align-items: flex-start;
  flex-wrap: wrap;
  gap: 10px;
}

.day-label {
  width: 30px;
  margin-top: 6px;
}

.off-day {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 14px;
  margin-top: 6px;
}

.time-picker-block {
  display: flex;
  align-items: center;
  gap: 6px;
}

.error {
  color: red;
  font-size: 12px;
}
</style>

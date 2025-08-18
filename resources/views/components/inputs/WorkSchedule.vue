<script setup>
import { DatePicker, CheckBox } from "@components";

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

      <CheckBox
        :modelValue="props.modelValue[day.key]?.is_working !== 'false'"
        @update:modelValue="
          (val) => updateDay(day.key, 'is_working', val ? 'true' : 'false')
        "
        :disabled="disabled"
      />

      <div
        class="time-picker-block"
        v-if="props.modelValue[day.key]?.is_working !== 'false'"
      >
        <DatePicker
          mode="time"
          :modelValue="modelValue[day.key]?.date_start"
          @update:modelValue="(val) => updateDay(day.key, 'date_start', val)"
          :name="`${name}[${day.key}][date_start]`"
          :disabled="disabled"
        />
        <DatePicker
          mode="time"
          :modelValue="modelValue[day.key]?.date_end"
          @update:modelValue="(val) => updateDay(day.key, 'date_end', val)"
          :name="`${name}[${day.key}][date_end]`"
          :disabled="disabled"
        />
        <span
          v-if="!modelValue[day.key]?.date_start || !modelValue[day.key]?.date_end"
          class="error-message"
        >
          *
        </span>
      </div>
    </div>
  </div>
</template>

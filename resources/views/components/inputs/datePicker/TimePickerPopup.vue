<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  modelValue: String,
});
const emit = defineEmits(["update:modelValue", "close"]);

const tempHour = ref(null);
const tempMinute = ref(null);

const userSelectedHour = ref(false);
const userSelectedMinute = ref(false);

watch(
  () => props.modelValue,
  (val) => {
    if (val && typeof val === "string") {
      const [h, m] = val.split(":");
      tempHour.value = parseInt(h);
      tempMinute.value = parseInt(m);
    } else {
      tempHour.value = null;
      tempMinute.value = null;
    }
    userSelectedHour.value = false;
    userSelectedMinute.value = false;
  },
  { immediate: true }
);

const updateValue = () => {
  if (tempHour.value !== null && tempMinute.value !== null) {
    emit("update:modelValue", `${pad(tempHour.value)}:${pad(tempMinute.value)}`);
  }
};

const pad = (n) => String(n).padStart(2, "0");

const selectHour = (hour) => {
  tempHour.value = hour;
  userSelectedHour.value = true;
  updateValue();
  tryEmit();
};

const selectMinute = (minute) => {
  tempMinute.value = minute;
  userSelectedMinute.value = true;
  updateValue();
  tryEmit();
};

const tryEmit = () => {
  if (userSelectedHour.value && userSelectedMinute.value) {
    emit("close");
  }
};

const hours = Array.from({ length: 24 }, (_, i) => i);
const minutes = Array.from({ length: 60 }, (_, i) => i);
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

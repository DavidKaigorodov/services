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
    <input type="hidden" :value="modelValue" v-bind="$attrs" :disabled="props.disabled" />
  </div>
</template>

<style scoped>
.datepicker-input.disabled {
  opacity: 0.6;
  cursor: not-allowed;
  pointer-events: none;
}
</style>

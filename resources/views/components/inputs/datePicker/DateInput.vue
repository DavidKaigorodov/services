<script setup>
import CalendarIco from "../../icons/CalendarIco.vue";
defineProps({
  modelValue: String,
});
defineEmits(["toggle"]);
</script>

<template>
  <div class="input datepicker-input" @click="$emit('toggle')">
    <span class="input-text">{{ modelValue }}</span>
    <div class="ico-calendar">
      <CalendarIco />
    </div>
    <input type="hidden" :value="modelValue" />
  </div>
</template>

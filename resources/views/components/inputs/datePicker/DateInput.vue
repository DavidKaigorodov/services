<script setup>
import StringInput from "../../forms/inputs/StringInput.vue";

defineProps({
  modelValue: String,
});
defineEmits(["toggle"]);
</script>

<template>
  <StringInput
    name="datepicker-input"
    :value="modelValue"
    readonly="true"
    @click="$emit('toggle')"
    autocomplete="datepicker-input"
  />
</template>

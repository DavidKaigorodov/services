<script setup>
import { Label, FormItem } from "@components";

const props = defineProps({
  rows: Number,
  value: {
    type: [String, Number, null],
    default: "",
  },
  placeholder: {
    type: String,
    default: "",
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  autocomplete: {
    type: String,
    default: "",
  },
  id: String,
  name: String,
  label: String,
});

const emit = defineEmits(["click"]);
const inputId = props.id ?? props.name;
const placeholderText = props.placeholder ?? "";
</script>
<template>
  <FormItem :name="name">
    <Label :labelText="label" />
    <textarea
      :rows="rows"
      :id="inputId"
      :name="name"
      :value="value ?? ''"
      @input="$emit('update:value', $event.target.value)"
      :placeholder="placeholderText"
      :disabled="disabled"
      @click="$emit('click', $event)"
      v-bind="$attrs"
    />
  </FormItem>
</template>

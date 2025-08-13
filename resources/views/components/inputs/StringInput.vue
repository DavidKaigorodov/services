<script setup>
import { Label, FormItem } from "@components";

const props = defineProps({
  type: {
    type: String,
    default: "text",
  },
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
  id: {
    type: String,
    default: null,
  },
  name: String,
  label: String,
  readonly: Boolean,
});

const emit = defineEmits(["update:value", "click", "keydown"]);

const inputId = props.id ?? props.name;
const placeholderText = props.placeholder ?? "";
</script>

<template>
  <FormItem :name="name">
    <Label :labelText="label" />
    <input
      :type="type"
      :id="inputId"
      :name="name"
      :value="value ?? ''"
      @input="$emit('update:value', $event.target.value)"
      :placeholder="placeholderText"
      :disabled="disabled"
      :autocomplete="autocomplete"
      :readonly="readonly"
      @keydown="$emit('keydown', $event)"
      @click="$emit('click', $event)"
      v-bind="$attrs"
    />
  </FormItem>
</template>

<script setup>
const props = defineProps({
  modelValue: {
    type: Boolean,
    default: false,
  },
  label: {
    type: String,
    default: "",
  },
  disabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:modelValue"]);

const toggle = () => {
  if (props.disabled) return;
  emit("update:modelValue", !props.modelValue);
};
</script>

<template>
  <label class="custom-checkbox" :class="{ disabled: props.disabled }" @click="toggle">
    <span class="checkbox-box">
      <svg v-if="props.modelValue" viewBox="0 0 24 24" class="checkmark">
        <path fill="none" stroke="#83adf0" stroke-width="3" d="M4 12l6 6L20 6" />
      </svg>
    </span>
    <span class="checkbox-label" v-if="props.label">{{ props.label }}</span>
  </label>
</template>

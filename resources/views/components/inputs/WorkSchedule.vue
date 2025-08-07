<script setup>
import TimeInput from "./TimeInput.vue";
import Label from "../Label.vue";

const props = defineProps({
  modelValue: {
    type: Object,
    required: true,
  },
  name: String,
  header: String,
});

const emit = defineEmits(["update:modelValue"]);

const updateDay = (dayKey, value) => {
  emit("update:modelValue", {
    ...props.modelValue,
    [dayKey]: value,
  });
};
</script>

<template>
  <div class="work-schedule-section">
    <div class="time-range-wrapper">
      <TimeInput
        label="Пн:"
        :model-value="modelValue.mon"
        @update:model-value="(value) => updateDay('mon', value)"
        :name="`${name}[mon]`"
      />
    </div>

    <div class="time-range-wrapper">
      <TimeInput
        label="Вт:"
        :model-value="modelValue.tue"
        @update:model-value="(value) => updateDay('tue', value)"
        :name="`${name}[tue]`"
      />
    </div>

    <div class="time-range-wrapper">
      <TimeInput
        label="Ср:"
        :model-value="modelValue.wed"
        @update:model-value="(value) => updateDay('wed', value)"
        :name="`${name}[wed]`"
      />
    </div>

    <div class="time-range-wrapper">
      <TimeInput
        label="Чт:"
        :model-value="modelValue.thu"
        @update:model-value="(value) => updateDay('thu', value)"
        :name="`${name}[thu]`"
      />
    </div>

    <div class="time-range-wrapper">
      <TimeInput
        label="Пт:"
        :model-value="modelValue.fri"
        @update:model-value="(value) => updateDay('fri', value)"
        :name="`${name}[fri]`"
      />
    </div>

    <div class="time-range-wrapper">
      <TimeInput
        label="Сб:"
        :model-value="modelValue.sat"
        @update:model-value="(value) => updateDay('sat', value)"
        :name="`${name}[sat]`"
      />
    </div>

    <div class="time-range-wrapper">
      <TimeInput
        label="Вс:"
        :model-value="modelValue.sun"
        @update:model-value="(value) => updateDay('sun', value)"
        :name="`${name}[sun]`"
      />
    </div>
  </div>
</template>

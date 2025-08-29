<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";

import { default as CalendarPopup } from "./CalendarPopup.vue";
import { default as TimePickerPopup } from "./TimePickerPopup.vue";
import { default as DateInput } from "./DateInput.vue";

import { default as Label} from "../../Label.vue";
import { default as FormItem } from "../../FormItem.vue";
import { formatDate } from "./utils";

const props = defineProps({
  modelValue: String,
  mode: {
    type: String,
    validator: (value) => ["date", "time"].includes(value),
    default: "date",
  },
  name: String,
  label: String,
  disabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:modelValue"]);

const show = ref(false);
const wrapperRef = ref(null);

const togglePopup = () => {
  if (props.disabled) return;
  show.value = !show.value;
};

const updateValue = (val) => {
  emit("update:modelValue", val);
};

const handleClose = () => {
  show.value = false;
};

const formattedValue = computed(() => {
  if (!props.modelValue) return "";
  return props.mode === "date"
    ? formatDate(props.modelValue, "DD.MM.YYYY")
    : props.modelValue;
});

const handleClickOutside = (event) => {
  const wrapper = wrapperRef.value;
  const popup = event.target.closest(".calendar-popup");

  if (wrapper?.contains(event.target) || popup) {
    return;
  }

  show.value = false;
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", handleClickOutside);
});

const popupStyles = computed(() => {
  if (!show.value || !wrapperRef.value) return {};

  const rect = wrapperRef.value.getBoundingClientRect();

  return {
    position: "absolute",
    left: `${rect.left}px`,
    top: `${rect.bottom + window.scrollY}px`,
    zIndex: "10000",
    width: `${rect.width}px`,
  };
});
</script>

<template>
  <FormItem :name="name">
    <Label v-if="label !== ''" :labelText="label" />
    <div class="datepicker-wrapper" ref="wrapperRef">
      <DateInput
        :modelValue="formattedValue"
        @toggle="togglePopup"
        :disabled="props.disabled"
        v-bind="$attrs"
      />
      <Teleport to="body">
        <component
          :is="mode === 'time' ? TimePickerPopup : CalendarPopup"
          v-if="show"
          :modelValue="modelValue"
          @update:modelValue="updateValue"
          @close="handleClose"
          class="calendar-popup"
          :style="popupStyles"
        />
      </Teleport>
    </div>
  </FormItem>
</template>

<style lang="sass" scoped>
.datepicker-wrapper
    position: relative
    display: inline-block
</style>

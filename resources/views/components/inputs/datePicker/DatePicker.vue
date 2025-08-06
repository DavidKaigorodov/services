<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import DateInput from "./DateInput.vue";
import CalendarPopup from "./CalendarPopup.vue";
import TimePickerPopup from "./TimePickerPopup.vue";
import { formatDate } from "./utils";
import FormItem from "../../forms/FormItem.vue";
import Label from "../../forms/Label.vue";

const props = defineProps({
  modelValue: String,
  mode: {
    type: String,
    validator: (value) => ["date", "time"].includes(value),
    default: "date",
  },
  name: String,
  label: String,
});

const emit = defineEmits(["update:modelValue"]);

const show = ref(false);
const wrapperRef = ref(null);

const togglePopup = () => {
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
  if (!wrapperRef.value?.contains(event.target)) {
    show.value = false;
  }
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
    <Label :labelText="label" />
    <div class="datepicker-wrapper" ref="wrapperRef">
      <DateInput :modelValue="formattedValue" @toggle="togglePopup" />
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

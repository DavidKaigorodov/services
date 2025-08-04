<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import DateInput from "./DateInput.vue";
import CalendarPopup from "./CalendarPopup.vue";
import { formatDate } from "./utils";

const props = defineProps({
  modelValue: String,
});
const emit = defineEmits(["update:modelValue"]);

const show = ref(false);
const wrapperRef = ref(null);

const togglePopup = () => {
  show.value = !show.value;
};

const updateValue = (val) => {
  emit("update:modelValue", val);
  show.value = false;
};

const formattedValue = computed(() =>
  props.modelValue ? formatDate(props.modelValue, "DD.MM.YYYY") : ""
);

const handleClickOutside = (event) => {
  if (wrapperRef.value && !wrapperRef.value.contains(event.target)) {
    show.value = false;
  }
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
  <div class="datepicker-wrapper" ref="wrapperRef">
    <DateInput :modelValue="formattedValue" @toggle="togglePopup" />
    <CalendarPopup
      v-if="show"
      :modelValue="modelValue"
      @update:modelValue="updateValue"
      class="calendar-popup"
    />
  </div>
</template>

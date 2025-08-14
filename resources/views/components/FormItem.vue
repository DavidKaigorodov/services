<script setup>
import { FormError } from "@components";

FormError;
const props = defineProps({
  name: String,
});
</script>
<template>
  <div :class="['form-item', name]">
    <slot />
    <FormError :name="name" />
  </div>
</template>

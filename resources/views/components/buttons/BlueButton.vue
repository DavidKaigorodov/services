<script setup>
import { BaseButton } from "@components";
</script>

<template>
  <BaseButton className="blue-button" v-bind="$attrs">
    <slot />
  </BaseButton>
</template>

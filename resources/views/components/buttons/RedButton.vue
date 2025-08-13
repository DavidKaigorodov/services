<script setup>
import { BaseButton } from "@components";
</script>

<template>
  <BaseButton className="red-button" v-bind="$attrs">
    <slot />
  </BaseButton>
</template>

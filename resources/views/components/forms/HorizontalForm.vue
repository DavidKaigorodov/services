<script setup>
import { BaseForm } from "@components";
</script>

<template>
  <BaseForm :header="''" className="horizontal-form">
    <slot />
  </BaseForm>
</template>

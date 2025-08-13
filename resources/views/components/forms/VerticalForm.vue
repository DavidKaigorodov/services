<script setup>
import { BaseForm } from "@components";
</script>

<template>
  <BaseForm :header="'123'" className="vertical-form">
    <slot />
  </BaseForm>
</template>

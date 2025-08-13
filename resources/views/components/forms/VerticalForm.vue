<script setup>
import BaseFrom from "@components";
</script>

<template>
  <BaseFrom :header="'123'" className="vertical-form">
    <slot />
  </BaseFrom>
</template>

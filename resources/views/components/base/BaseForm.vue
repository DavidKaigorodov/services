<script setup>
import { BlueButton } from "@components";

const props = defineProps({
  className: String,
  header: String,
  info: [String, Object, null],
  sbm: String,
  handleSubmit: Function,
});

const boxClassName = props.className ? `${props.className}-box` : "";
</script>

<template>
  <div :class="['form-container', boxClassName]">
    <form @submit="handleSubmit" :class="className">
      <h3 v-if="header" class="form-header">
        {{ header }}
      </h3>

      <div class="form-errors"></div>

      <div class="form-content">
        <slot />
      </div>

      <div class="form-buttons">
        <BlueButton v-if="sbm" type="submit">
          {{ sbm }}
        </BlueButton>
      </div>

      <div class="form-backside">
        <component :is="info" v-if="info && typeof info === 'object'" />
        <span v-else-if="info">
          {{ info }}
        </span>
      </div>
    </form>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import PenIco from "@components";

defineProps({
  href: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Link :href="href" class="button blue-button" v-bind="$attrs">
    <PenIco />
  </Link>
</template>

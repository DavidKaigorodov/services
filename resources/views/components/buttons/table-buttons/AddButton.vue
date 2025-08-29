<script setup>
import { Link } from "@inertiajs/vue3";
import { default as PlusIco } from "../../icons/PlusIco.vue";

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Link :href="href" class="button blue-button" v-bind="$attrs">
    <PlusIco />
  </Link>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
  href: {
    type: String,
  },
  label: String,
  params: {
    type: Object,
  },
});

function goto(e) {
  e.preventDefault();

  router.get(route(props.href, props.params));
}
</script>

<template>
  <li>
    <Link :href="props.href" @click="goto" v-bind="$attrs">
      {{ label }}
    </Link>
  </li>
</template>

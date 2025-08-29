<script setup>
import { router } from "@inertiajs/vue3";

import { default as RedButton } from "../../buttons/RedButton.vue";
import { default as TrashIco } from "../../icons/TrashIco.vue";

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
});

function destroy() {
  if (confirm("Вы уверены, что хотите удалить запись?")) {
    router.delete(props.href);
  }
}
</script>

<template>
  <RedButton @click="destroy">
    <TrashIco />
  </RedButton>
</template>

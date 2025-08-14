<!-- resources/js/Components/TabMenu.vue -->
<script setup>
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
    default: false,
  },
});

function goto(e) {
  e.preventDefault();
  router.get(route(props.href));
}
</script>

<template>
  <li class="tab-item" :class="{ active: active }">
    <Link :href="href" @click="goto" class="tab-link">
      {{ label }}
    </Link>
  </li>
</template>

<style scoped>
.tab-item {
  list-style: none;
  display: inline-block;
  margin: 0 8px;
}

.tab-link {
  display: inline-block;
  padding: 10px 16px;
  text-decoration: none;
  color: #555;
  border-radius: 6px 6px 0 0;
  font-size: 14px;
  transition: all 0.2s ease;
  border-bottom: 3px solid transparent;
}

.tab-link:hover {
  color: var(--palette-color-4);
}

.tab-item.active .tab-link {
  color: var(--palette-color-4);
  font-weight: 600;
  border-bottom: 3px solid var(--palette-color-4);
}
</style>

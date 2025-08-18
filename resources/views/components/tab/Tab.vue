<script setup>
import TabItem from "./TabItem.vue";

const props = defineProps({
  tabs: {
    type: Array,
    required: true,
  },
  params: Object,
});
</script>

<template>
  <nav class="tab-bar">
    <ul class="tab-list">
      <TabItem
        v-for="tab in tabs"
        :key="tab.href"
        :href="tab.href"
        :label="tab.title"
        :active="route().current(tab.href)"
        :params="props.params"
      />
    </ul>
  </nav>
</template>

<style scoped>
.tab-bar {
  background: #f8f9fa;
  border-bottom: 1px solid #ddd;
  padding: 0 16px;
}

.tab-list {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 4px;
  align-items: flex-end;
}
</style>

<script setup>
import { getObjectValue } from "@helpers";

const props = defineProps({
  data: [Array, Object],
  columns: Array,
  header: String,
});
</script>

<template>
  <div class="table-container">
    <h3 v-if="header" class="table-header">{{ header }}</h3>

    <div class="table-toolbar">
      <div class="toolbar-left">
        <slot name="toolbar-left" />
      </div>
      <div class="toolbar-right">
        <slot name="toolbar-right" />
      </div>
    </div>

    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th v-for="{ key, label } in columns" :key="key">
              {{ label }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(row, r_index) in data.data" :key="r_index">
            <td v-for="(cell, c_index) in columns" :key="c_index">
              <div v-if="cell.key == 'actions'" class="table-actions">
                <slot name="actions" :row="row" />
              </div>
              <div v-else>
                {{ getObjectValue(cell.key, row) }}
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

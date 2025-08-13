<script setup>
import { usePage } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { Table, EditButton, DeleteButton, AddButton } from "@components";

const columns = [
  { key: "name", label: "Наименовение" },
  { key: "actions", label: "" },
];
</script>

<template>
  <AuthenticatedLayout>
    <Table :data="usePage().props.cities" :columns="columns" header="Города">
      <template #toolbar-right>
        <AddButton :href="route('cities.create')" />
      </template>

      <template #actions="{ row }">
        <EditButton :href="route('cities.edit', row)" />
        <DeleteButton :href="route('cities.destroy', row)" />
      </template>
    </Table>
  </AuthenticatedLayout>
</template>

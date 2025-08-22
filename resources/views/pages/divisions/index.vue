<script setup>
import { usePage } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { Table, EditButton, DeleteButton, AddButton, GoToButton } from "@components";

const columns = [
  { key: "name", label: "Наименование" },
  { key: "address", label: "Адрес" },
  { key: ["city", "name"], label: "Город" },
  { key: "actions", label: "" },
];
</script>

<template>
  <AuthenticatedLayout>
    <Table :data="usePage().props.divisions" :columns="columns" header="Подразделения">
      <template #toolbar-right>
        <AddButton href="/divisions/create" />
      </template>

      <template #actions="{ row }">
        <EditButton :href="route('divisions.edit', row)" />
        <DeleteButton :href="route('divisions.destroy', row)" />
        <GoToButton :href="route('divisions.show', row.id)"/>
      </template>
    </Table>
  </AuthenticatedLayout>
</template>

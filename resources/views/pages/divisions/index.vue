<script setup>
import { usePage } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "../../layouts";

import { Table, EditButton, DeleteButton, AddButton } from "../../components";

const columns = [
  { key: "name", label: "Наименование" },
  { key: "address", label: "Адрес" },
  { key: "city_id", label: "Город" },
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
      </template>
    </Table>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";
import Table from "../../components/table/Table.vue";
import EditButton from "../../components/table/buttons/EditButton.vue";
import DeleteButton from "../../components/table/buttons/DeleteButton.vue";
import AddButton from "../../components/table/buttons/AddButton.vue";
import { usePage } from "@inertiajs/vue3";

const columns = [
  { key: "address", label: "Адрес" },
  { key: "name", label: "Наименование" },
  { key: "city_id", label: "Город" },
  { key: "created_at", label: "Дата создания" },
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

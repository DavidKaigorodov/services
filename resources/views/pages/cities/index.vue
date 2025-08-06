<script setup>
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import Table from "../../components/table/Table.vue";
import EditButton from "../../components/table/buttons/EditButton.vue";
import DeleteButton from "../../components/table/buttons/DeleteButton.vue";
import AddButton from "../../components/table/buttons/AddButton.vue";
import { usePage } from "@inertiajs/vue3";

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

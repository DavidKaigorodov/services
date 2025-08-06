<script setup>
import { usePage } from "@inertiajs/vue3";

import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import Table from "../../components/table/Table.vue";
import EditButton from "../../components/table/buttons/EditButton.vue";
import DeleteButton from "../../components/table/buttons/DeleteButton.vue";
import AddButton from "../../components/table/buttons/AddButton.vue";

const columns = [
  { key: "name", label: "Наименование" },
  { key: "duration", label: "Продолжительность" },
  { key: "user", label: "Специалист" },
  { key: "actions", label: "" },
];
</script>

<template>
  <AuthenticatedLayout>
    <Table :data="usePage().props.services" :columns="columns" header="Услуга">
      <template #toolbar-right>
        <AddButton href="/service/create" />
      </template>

      <template #actions="{ row }">
        <EditButton :href="route('service.edit', row)" />
        <DeleteButton :href="route('service.destroy', row)" />
      </template>
    </Table>
  </AuthenticatedLayout>
</template>

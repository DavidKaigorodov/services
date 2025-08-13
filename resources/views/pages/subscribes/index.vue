<script setup>
import { usePage } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "../../layouts";

import { Table, EditButton, DeleteButton, AddButton } from "@components";

const columns = [
  { key: "last_name", label: "Фамилия" },
  { key: "first_name", label: "Имя" },
  { key: "middle_name", label: "Отчество" },
  { key: "email", label: "Email" },
  { key: "phone", label: "Телефон" },
  { key: "division_id", label: "Подразделение" },
  { key: "service_id", label: "Услуга" },
  { key: "actions", label: "" },
];
</script>

<template>
  <AuthenticatedLayout>
    <Table
      :data="usePage().props.subscribes"
      :columns="columns"
      header="Информация об организации"
    >
      <template #toolbar-right>
        <AddButton :href="route('subscribes.create')" />
      </template>

      <template #actions="{ row }">
        <EditButton :href="route('subscribes.edit', row)" />
        <DeleteButton :href="route('subscribes.destroy', row)" />
      </template>
    </Table>
  </AuthenticatedLayout>
</template>

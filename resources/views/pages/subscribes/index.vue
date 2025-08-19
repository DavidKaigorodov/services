<script setup>
import { usePage } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { Table } from "@components";

const columns = [
  { key: "last_name", label: "Фамилия" },
  { key: "first_name", label: "Имя" },
  { key: "middle_name", label: "Отчество" },
  { key: "email", label: "Email" },
  { key: "phone", label: "Телефон" },
  { key: ["division", "name"], label: "Подразделение" },
  { key: ["service", "name"], label: "Услуга" },
  { key: "start_at", label: "Время записи" },
];
</script>

<template>
  <AuthenticatedLayout>
    <Table
      :data="usePage().props.subscribes"
      :columns="columns"
      header="Список обращений"
    >
    </Table>
  </AuthenticatedLayout>
</template>

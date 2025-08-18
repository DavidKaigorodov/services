<script setup>
import { AuthenticatedLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { Table, AddButton } from "@components";
import { usePage } from "@inertiajs/vue3";

const worker = usePage().props.users;

const columns = [
  { key: "name", label: "Фамилия" },
  { key: "email", label: "Email" },
  { key: "actions", label: "" },
];
</script>
<template>
  <AuthenticatedLayout>
    <DivisionTab>
      <Table :data="worker" :columns="columns"> </Table>
    </DivisionTab>
  </AuthenticatedLayout>
</template>

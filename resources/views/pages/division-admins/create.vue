<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { AuthenticatedLayout } from "@layouts";
import { Table, CheckBox, GoToButton } from "@components";
import { DivisionTab } from "@includes";

const { division, users } = usePage().props;
const admins = ref(users);

const columns = [
  { key: "name", label: "Фамилия" },
  { key: "email", label: "Email" },
  { key: "actions", label: "Админ" },
];

const toggleCheckbox = (row, val) => {
  row.role = val ? "division_admin" : "division_worker";

  router.put(route("users.update", { division: division.id, user: row.id }), {
    role: row.role,
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <DivisionTab>
      <Table :data="admins" :columns="columns">
        <template #toolbar-right>
          <GoToButton :href="route('division-admins.index', { division: division.id })" />
        </template>

        <template #actions="{ row }">
          <CheckBox
            :modelValue="row.role === 'division_admin'"
            @update:modelValue="(val) => toggleCheckbox(row, val)"
          />
        </template>
      </Table>
    </DivisionTab>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { AuthenticatedLayout } from "@layouts";
import { Table, CheckBox, GoToButton } from "@components";
import { DivisionTab } from "@includes";

const users = usePage().props.users;
const division = usePage().props.division.data;

const admins = ref(users);

const columns = [
    { key: "name", label: "Фамилия" },
    { key: "email", label: "Email" },
    { key: "actions", label: "Админ" },
];

const toggleCheckbox = (row, val) => {
    row.role.code = val ? "division_admin" : "division_worker";
    console.log(val);

    val === true
        ? router.post(
              route("division-admins.store", { division: division.id }),
              {
                  user_id: row.id,
              },
          )
        : router.delete(
              route("division-admins.destroy", {
                  division: division.id,
                  division_admin: row.id,
              }),
          );
};

</script>

<template>
    <AuthenticatedLayout>
        <DivisionTab :division_id="division.id">
            <Table :data="admins" :columns="columns">
                <template #toolbar-right>
                    <GoToButton
                        :href="
                            route('division-admins.index', {
                                division: division.id,
                            })
                        "
                    />
                </template>

                <template #actions="{ row }">
                    <CheckBox
                        :modelValue="row.role.code === 'division_admin'"
                        @update:modelValue="(val) => toggleCheckbox(row, val)"
                    />
                </template>
            </Table>
        </DivisionTab>
    </AuthenticatedLayout>
</template>

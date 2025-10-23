<script setup>
import { AuthenticatedLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { Table, AddButton, DeleteButton, EditButton } from "@components";
import { usePage } from "@inertiajs/vue3";

const worker = usePage().props.users;

const division = usePage().props.division.data;

const columns = [
    {
        label: "ФИО",
        render: (row) => {
            return row.last_name + ' ' + row.first_name[0] + ". " + row.middle_name[0] + ".";
        },
    },
    { key: "email", label: "Email" },
    { key: "actions", label: "" },
];
</script>

<template>
    <AuthenticatedLayout>
        <DivisionTab current="workers">
            <Table :data="worker" :columns="columns">
                <template #toolbar-right>
                    <AddButton :href="route('invites.create', { division_id: division.id })" />
                </template>

                <template #actions="{ row }">
                    <EditButton :href="route('workers.edit', { worker: row.id })" />
                    <DeleteButton :href="route('workers.destroy', { division: division.id, worker: row.id })" />
                </template>
            </Table>
        </DivisionTab>
    </AuthenticatedLayout>
</template>

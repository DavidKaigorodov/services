<script setup>
import { AuthenticatedLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { Table, AddButton, DeleteButton, EditButton } from "@components";
import { usePage } from "@inertiajs/vue3";

const worker = usePage().props.users;

const division = usePage().props.division.data;

const columns = [
    { key: "name", label: "Фамилия" },
    { key: "email", label: "Email" },
    { key: "actions", label: "" },
];
</script>
<template>
    <AuthenticatedLayout>
        <DivisionTab :division_id="division.id">
            <Table :data="worker" :columns="columns">
                <template #toolbar-right>
                    <AddButton :href="route('workers.create', division.id)" />
                </template>
                <template #actions="{ row }">
                    <EditButton :href="route('workers.edit',{ division: division.id, worker: row.id})" />
                    <DeleteButton :href="route('workers.destroy', { division: division.id, worker: row.id})" />
                </template>
            </Table>
        </DivisionTab>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import Table from "../../components/table/Table.vue";
import EditButton from "../../components/table/buttons/EditButton.vue";
import DeleteButton from "../../components/table/buttons/DeleteButton.vue";
import AddButton from "../../components/table/buttons/AddButton.vue";

const cities = [
    {
        id: 1,
        name: "Сигма",
    },
    {
        id: 1,
        name: "Сигма",
    },
    {
        id: 2,
        name: "Бой",
    },
    {
        id: 1,
        name: "Сигма",
    },
    {
        id: 2,
        name: "Бой",
    },
    {
        id: 1,
        name: "Сигма",
    },
    {
        id: 2,
        name: "Бой",
    },
    {
        id: 3,
        name: "Каждая",
    },
    {
        id: 4,
        name: "Девченка",
    },
    {
        id: 5,
        name: "Хочет",
    },
    {
        id: 6,
        name: "Танцевать",
    },
    {
        id: 7,
        name: "С",
    },
    {
        id: 8,
        name: "Тобой",
    },
];

const columns = [
    { key: "name", label: "Наименовение" },
    { key: "actions", label: "" },
];
</script>

<template>
    <AuthenticatedLayout>
        <Table :data="cities" :columns="columns" header="Города">
            <template #toolbar-right>
                <AddButton href="/add" />
            </template>

            <template #actions="{ row }">
                <EditButton href="/edit" />
                <DeleteButton href="/delete" />
            </template>
        </Table>
    </AuthenticatedLayout>
</template>

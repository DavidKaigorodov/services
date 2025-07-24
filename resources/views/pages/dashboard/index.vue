<script setup>
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";
import Table from "../../components/tables/Table.vue";
import EditButton from "../../components/tables/buttons/EditButton.vue";
import DeleteButton from "../../components/tables/buttons/DeleteButton.vue";

const users = [
    {
        id: 1,
        name: "Анна",
        email: "anna@example.com",
        role: "aboba",
        division: "1",
    },
    {
        id: 2,
        name: "Борис",
        email: "boris@example.com",
        role: "popa",
        division: "2",
    },
    {
        id: 3,
        name: "Виктория",
        email: "vika@example.com",
        role: "pipa",
        division: "3",
    },
];

const columns = [
    { key: "name", label: "Имя" },
    { key: "email", label: "Email" },
    { key: "role", label: "Роль" },
    { key: "division", label: "Подразделение" },
    { key: "actions", label: "" },
];
</script>

<template>
    <AuthenticatedLayout>
        <Table :data="users" :columns="columns" header="Пользователи">
            <template #name="{ value }">
                {{ value }}
            </template>

            <template #actions="{ row }">
                <EditButton href="Ссылка" />
                <DeleteButton href="Ссылка" />
            </template>
        </Table>
    </AuthenticatedLayout>
</template>

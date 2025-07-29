<script setup>
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";
import Table from "../../components/table/Table.vue";
import EditButton from "../../components/table/buttons/EditButton.vue";
import DeleteButton from "../../components/table/buttons/DeleteButton.vue";
import AddButton from "../../components/table/buttons/AddButton.vue";

const users = [
    {
        id: 1,
        name: "УСЗН Центрального района",
        operation_mode: "Каждый день",
        city: "aboba",
        responsible: "Крутой чел",
    },
    {
        id: 2,
        name: "УСЗН Кировского района",
        operation_mode: "Не каждый день",
        city: "popa",
        responsible: "Так себе чел",
    },
    {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН Южного района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
        {
        id: 3,
        name: "УСЗН крутого района",
        operation_mode: "Когда захотят",
        city: "pipa",
        responsible: "Не так себе чел",
    },
];

const columns = [
    { key: "name", label: "Наименовение" },
    { key: "operation_mode", label: "Режим работы" },
    { key: "city", label: "город" },
    { key: "responsible", label: "Ответственное лицо" },
    { key: "actions", label: "" },
];
</script>

<template>
    <AuthenticatedLayout>
        <Table :data="users" :columns="columns" header="Пользователи">
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

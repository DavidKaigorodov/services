<script setup>
import { usePage } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import {
    Table,
    EditButton,
    DeleteButton,
    AddButton,
    GoToButton,
} from "@components";

const columns = [
    { key: "name", label: "Наименование", width: "342px" },
    { key: "address", label: "Адрес" },
    { key: ["city", "name"], label: "Город", width: "160px" },
    { key: "actions", label: "", width: "175px" },
];
</script>

<template>
    <AuthenticatedLayout>
        <Table
            :data="usePage().props.divisions"
            :columns="columns"
            header="Подразделения"
        >
            <template #toolbar-right>
                <AddButton href="/divisions/create" />
            </template>

            <template #actions="{ row }">
                <DeleteButton
                    v-if="row.userCount === 0"
                    :href="route('divisions.destroy', row)"
                />
                <EditButton :href="route('divisions.edit', row)" />

                <GoToButton :href="route('divisions.show', row.id)" />
            </template>
        </Table>
    </AuthenticatedLayout>
</template>

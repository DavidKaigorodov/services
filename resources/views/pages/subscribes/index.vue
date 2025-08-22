<script setup>
import { usePage } from "@inertiajs/vue3";
import { AuthenticatedLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { Table, GoToButton } from "@components";

const role = usePage().props.current_user.data.role.code;
const division = usePage().props.division.data;
let columns = [];

if (role === "admin" || role === "root") {
    columns = [
        { key: "last_name", label: "Фамилия" },
        { key: "first_name", label: "Имя" },
        { key: "middle_name", label: "Отчество" },
        { key: ["division", "name"], label: "Подразделение" },
        { key: ["service", "name"], label: "Услуга" },
        { key: "start_at", label: "Время записи" },
        { key: ["worker", "name"], label: "Специалист" },
        { key: "actions", label: "" },
    ];
} else {
    columns = [
        { key: "last_name", label: "Фамилия" },
        { key: "first_name", label: "Имя" },
        { key: "middle_name", label: "Отчество" },
        { key: ["service", "name"], label: "Услуга" },
        { key: "start_at", label: "Время записи" },
        { key: ["worker", "name"], label: "Специалист" },
        { key: "actions", label: "" },
    ];
}
</script>

<template>
    <AuthenticatedLayout>
        <DivisionTab :division_id="division.id">
            <Table
                :data="usePage().props.subscribes"
                :columns="columns"
                header="Список обращений"
            >
                <template #actions="{ row }">
                    <GoToButton
                        :href="route('subscribes.show', {division: division.id, subscribe: row.id })"
                    />
                </template>
            </Table>
        </DivisionTab>
    </AuthenticatedLayout>
</template>

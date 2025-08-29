<script setup>
import { usePage } from "@inertiajs/vue3";
import { AuthenticatedLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { Table, GoToButton } from "@components";

const role = usePage().props.current_user.data.role.code;
const division = usePage().props.division.data;
let columns = [];

if (role === "admin") {
    columns = [
        { key: "last_name", label: "Фамилия", width: "150px" },
        { key: "first_name", label: "Имя", width: "150px" },
        { key: "middle_name", label: "Отчество", width: "150px" },
        { key: ["division", "name"], label: "Подразделение", width: "200px" },
        { key: ["service", "name"], label: "Услуга"},
        { key: "start_at", label: "Дата записи", splitDateTime: true, width: "105px" },
        { key: ["worker", "name"], label: "Специалист", width: "150px" },
        { key: "actions", label: "", width: "60px"  },
    ];
} else {
   columns = [
        { key: "last_name", label: "Фамилия", width: "150px" },
        { key: "first_name", label: "Имя", width: "150px" },
        { key: "middle_name", label: "Отчество", width: "150px" },
        { key: ["service", "name"], label: "Услуга"},
        { key: "start_at", label: "Дата записи", splitDateTime: true, width: "105px" },
        { key: ["worker", "name"], label: "Специалист", width: "150px" },
        { key: "actions", label: "", width: "60px"  },
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

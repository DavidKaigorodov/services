<script setup>
import { usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "../../components/layouts/AuthenticatedLayout.vue";
import Table from "../../components/tables/Table.vue";
import EditButton from "../../components/tables/buttons/EditButton.vue";
import DeleteButton from "../../components/tables/buttons/DeleteButton.vue";

const users = [
    {  name: "Анна", email: "anna@example.com", role: "aboba", division: "1"  },
    {  name: "Борис", email: "boris@example.com", role: "popa", division: "2" },
    {  name: "Виктория", email: "vika@example.com", role: "pipa", division: "3" },

];

const columns = [
    { key: "name", label: "Имя" },
    { key: "email", label: "Email" },
    { key: "role", label: "Роль" },
    { key: "division", label: "Подраделение" },
    { key: "actions", label: "" },
];

const editUser = (user) => {
    console.log("Редактировать:", user);
    //убрать и передать роут в саму кнопку
};

const deleteUser = (id) => {
    console.log("Удалить пользователя:", id);
    // убрать и передать роут в саму кнопку
};

// const user = usePage().props.users
</script>
<template>
    <AuthenticatedLayout>
        <div>
            <Table :data="users" :columns="columns" header="Пользователи">
                <template #actions="{ row }">
                    <div class="table-actions">
                        <EditButton @click="editUser(row)" />
                        <DeleteButton @click="deleteUser(row.id)" />
                    </div>
                </template>

                <template #name="{ value }">
                    {{ value }}
                </template>
            </Table>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.table-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}
</style>

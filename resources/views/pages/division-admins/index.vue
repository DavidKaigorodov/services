<script setup>
import { AuthenticatedLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { Table, EditButton } from "@components";
import { usePage } from "@inertiajs/vue3";

const admins = usePage().props.users;
const division = usePage().props.division.data;

const columns = [
    { key: "name", label: "Фамилия" },
    { key: "email", label: "Email" },
    { key: "action", label: "" },
];
</script>
<template>
    <AuthenticatedLayout>
        <DivisionTab :division_id="division.id" >
            <Table :data="admins" :columns="columns">
                <template #toolbar-right>
                    <EditButton
                        :href="
                            route('division-admins.create', {
                                division: division.id,
                            })
                        "
                    />
                </template>
            </Table>
        </DivisionTab>
    </AuthenticatedLayout>
</template>

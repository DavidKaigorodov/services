<script>
import { usePage, router } from "@inertiajs/vue3";
import { AuthenticatedLayout } from "@layouts";
import { Table, CheckBox, GoToButton } from "@components";
import { DivisionTab } from "@includes";

export default {
    components: {
        AuthenticatedLayout,
        Table,
        CheckBox,
        GoToButton,
        DivisionTab,
    },

    data() {
        const users = usePage().props.users;
        const division = usePage().props.division.data;

        return {
            admins: users,
            division,
            columns: [
                { key: "name", label: "Фамилия" },
                { key: "email", label: "Email" },
                { key: "actions", label: "" },
            ],
        };
    },

    methods: {
        toggleCheckbox(row, val) {
            row.role.code = val ? "division_admin" : "division_worker";

            if (val) {
                router.post(
                    route("division-admins.store", { division: this.division.id }), { user_id: row.id });
            } else {
                router.delete(
                    route("division-admins.destroy", { division: this.division.id, division_admin: row.id }),
                );
            }
        },
    },
};
</script>

<template>
    <AuthenticatedLayout>
        <DivisionTab :division_id="division.id">
            <Table :data="admins" :columns="columns">
                <template #toolbar-right>
                    <GoToButton
                        :href="route('division-admins.index', { division: division.id })"
                    />
                </template>

                <template #actions="{ row }">
                    <CheckBox
                        :modelValue="row.role.code === 'division_admin'"
                        @update:modelValue="(val) => toggleCheckbox(row, val)"
                    />
                </template>
            </Table>
        </DivisionTab>
    </AuthenticatedLayout>
</template>

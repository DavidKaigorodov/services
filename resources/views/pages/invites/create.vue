<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { GuestLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { VerticalForm, StringInput } from "@components";

const division = usePage().props.division.data;

const form = useForm({
    email: "",
});

function onSubmit(e) {
    e.preventDefault();

    form.post(route("invites.store", {division_id: division.id}));
}
</script>

<template>
    <GuestLayout>
        <DivisionTab :division_id="division.id">
            <VerticalForm
                header="Отправить приглашение"
                sbm="Отправить"
                :handleSubmit="onSubmit"
            >
                <StringInput
                    label="Email"
                    name="email"
                    :value="form.email"
                    @update:value="(val) => (form.email = val)"
                    autocomplete="username"
                />
            </VerticalForm>
        </DivisionTab>
    </GuestLayout>
</template>

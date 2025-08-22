<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { GuestLayout } from "@layouts";
import { DivisionTab } from "@includes";
import { VerticalForm, StringInput } from "@components";

const division = usePage().props.division.data;

const form = useForm({
    login: "",
});

function onSubmit(e) {
    e.preventDefault();

    form.post(route("auhtificate"));
}
</script>

<template>
    <GuestLayout>
        <DivisionTab :division_id="division.id">
            <VerticalForm
                header="Отправить приглашение"
                sbm="Войти"
                :handleSubmit="onSubmit"
            >
                <StringInput
                    label="Email"
                    name="login"
                    :value="form.login"
                    @update:value="(val) => (form.login = val)"
                    autocomplete="username"
                />
            </VerticalForm>
        </DivisionTab>
    </GuestLayout>
</template>

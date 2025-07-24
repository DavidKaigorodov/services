<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import VerticalForm from "../../components/forms/VerticalForm.vue";
import GuestLayout from "../../layouts/GuestLayout.vue";
import StringInput from "../../components/forms/inputs/StringInput.vue";

const form = ref({
    login: "",
    password: "",
});

function onSubmit(e) {
    e.preventDefault();

    router.post(('auhtificate'), form.value)
}
</script>

<template>
    <GuestLayout>
        <VerticalForm header="Вход" sbm="Войти" :handleSubmit="onSubmit">
            <StringInput
                label="Логин или Email"
                name="login"
                :value="form.login"
                @update:value="(val) => (form.login = val)"
                autocomplete="username"
            />

            <StringInput
                label="Пароль"
                type="password"
                name="password"
                :value="form.password"
                @update:value="(val) => (form.password = val)"
                autocomplete="current-password"
            />
        </VerticalForm>
    </GuestLayout>
</template>

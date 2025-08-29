<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { GuestLayout } from "@layouts";
import { VerticalForm, StringInput, CheckBox } from "@components";

const form = useForm({
    email: "",
    password: "",
    remember: false, // ✅ добавляем remember
});

function onSubmit(e) {
    e.preventDefault();
    form.post(route("auhtificate"));
}
</script>

<template>
    <GuestLayout>
        <VerticalForm header="Вход" sbm="Войти" :handleSubmit="onSubmit">
            <StringInput
                label="Логин или Email"
                name="email"
                :value="form.email"
                @update:value="(val) => (form.email = val)"
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

            <template #buttons>
                <CheckBox
                    label="Запомнить меня"
                    v-model="form.remember"
                />
            </template>

            <template #info>
                <div class="reset-password-link">
                    <Link :href="route('password.request')" class="reset">
                        Востановить пароль
                    </Link>
                </div>
            </template>
        </VerticalForm>
    </GuestLayout>
</template>

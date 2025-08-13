<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

import { GuestLayout } from "../../layouts";

import { VerticalForm, StringInput } from "@components";

const form = ref({
  login: "",
  password: "",
});

function onSubmit(e) {
  e.preventDefault();

  router.post(route("auhtificate"), form.value);
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

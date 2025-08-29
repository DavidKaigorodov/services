<script setup>
import { useForm } from "@inertiajs/vue3";

import { GuestLayout } from "@layouts";

import { VerticalForm, StringInput } from "@components";

const form = useForm({
  email: "",
});

function onSubmit(e) {
  e.preventDefault();

  form.post(route("password.email"));
}
</script>

<template>
  <GuestLayout>
    <VerticalForm header="Введите почту" sbm="Отправить" :handleSubmit="onSubmit">
      <StringInput
        label="Email"
        name="email"
        :value="form.email"
        @update:value="(val) => (form.email = val)"
        autocomplete="email"
      />
    </VerticalForm>
  </GuestLayout>
</template>

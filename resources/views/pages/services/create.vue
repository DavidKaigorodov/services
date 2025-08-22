<script setup>
import { useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { VerticalForm, DatePicker, Select, TextArea } from "@components";

const form = useForm({
  name: "",
  duration: "",
  user: "",
});

function onSubmit(e) {
  e.preventDefault();

  form.post(route("services.store"));
}
</script>

<template>
  <AuthenticatedLayout>
    <VerticalForm header="Услуги" sbm="Отправить" :handleSubmit="onSubmit">
      <TextArea
        label="Наименование"
        name="name"
        :value="form.name"
        @update:value="(val) => (form.name = val)"
        :rows="4"
      />
      <DatePicker
        v-model="form.duration"
        mode="time"
        name="duration"
        label="Продолжительность"
      />
      <Select :options="['123']" name="user" label="Специалист" />
    </VerticalForm>
  </AuthenticatedLayout>
</template>

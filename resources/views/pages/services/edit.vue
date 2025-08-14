<script setup>
import { usePage, useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { VerticalForm, DatePicker, Select, TextArea } from "@components";

const services = usePage().props.services.data;

const form = useForm({
  name: services.name,
  duration: services.duration,
  user: services.user,
});

function onSubmit(e) {
  e.preventDefault();

  form.put(route("service.update", { service: services.id }));
}
</script>

<template>
  <AuthenticatedLayout>
    <VerticalForm header="Услуги" sbm="Сохранить" :handleSubmit="onSubmit">
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
      <Select :options="[123]" name="user" label="Специалист" />
    </VerticalForm>
  </AuthenticatedLayout>
</template>

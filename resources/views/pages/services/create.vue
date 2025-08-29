<script setup>
import { useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { VerticalForm, DatePicker, TextArea } from "@components";

const form = useForm({
  name: "",
  duration: "",
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
    </VerticalForm>
  </AuthenticatedLayout>
</template>

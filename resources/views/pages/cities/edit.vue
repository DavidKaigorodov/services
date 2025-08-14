<script setup>
import { usePage, useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { VerticalForm, StringInput } from "@components";

const city = usePage().props.city.data;

const form = useForm({
  name: city.name,
});

function onSubmit(e) {
  e.preventDefault();

  form.put(route("cities.update", { city: city.id }));
}
</script>

<template>
  <AuthenticatedLayout>
    <VerticalForm header="Город" sbm="Сохранить" :handleSubmit="onSubmit">
      <StringInput
        label="Наименование"
        name="name"
        :value="form.name"
        @update:value="(val) => (form.name = val)"
        autocomplete="current-name"
      />
    </VerticalForm>
  </AuthenticatedLayout>
</template>

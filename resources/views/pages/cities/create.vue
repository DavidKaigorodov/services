<script setup>
import { ref } from "vue";

import { AuthenticatedLayout } from "@layouts";

import { VerticalForm, StringInput } from "@components";

const form = ref({
  name: "",
});

function onSubmit() {
  e.preventDefault();

  post(route("cities.store"), form);
}
</script>

<template>
  <AuthenticatedLayout>
    <VerticalForm header="Город" sbm="Отправить" :handleSubmit="onSubmit">
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

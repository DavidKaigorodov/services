<script setup>
import { ref } from "vue";

import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import HorizontalForm from "../../components/forms/HorizontalForm.vue";
import StringInput from "../../components/forms/inputs/StringInput.vue";

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
    <HorizontalForm header="Город" sbm="Отправить" :handleSubmit="onSubmit">
      <StringInput
        label="Наименование"
        name="name"
        :value="form.name"
        @update:value="(val) => (form.name = val)"
        autocomplete="current-name"
      />
    </HorizontalForm>
  </AuthenticatedLayout>
</template>

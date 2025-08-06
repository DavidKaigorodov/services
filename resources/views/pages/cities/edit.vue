<script setup>
import { ref } from "vue";

import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import HorizontalForm from "../../components/forms/HorizontalForm.vue";
import StringInput from "../../components/forms/inputs/StringInput.vue";
import { usePage } from "@inertiajs/vue3";

const city = usePage().props.city.data;

const form = ref({
  name: city.name,
});

function onSubmit() {
  e.preventDefault();

  put(route("cities.update", { city: city.id }), form);
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

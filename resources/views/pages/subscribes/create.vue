<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import VerticalForm from "../../components/forms/VerticalForm.vue";
import StringInput from "../../components/forms/inputs/StringInput.vue";
import Select from "../../components/forms/inputs/select/Select.vue";

const form = ref({
  last_name: "",
  first_name: "",
  middle_name: "",
  email: "",
  phone: "",
  division_id: "",
  service_id: "",
});

function onSubmit() {
  e.preventDefault();

  put(route("subscribes.update"), form);
}
const division = [
  { value: 1, label: "Крутой" },
  { value: 2, label: "Балдежный" },
  { value: 3, label: "Чилловый" },
  { value: 4, label: "Пивной" },
  { value: 5, label: "Пятничный" },
  { value: 6, label: "Пудж" },
  { value: 9, label: "ФредиФасбер" },
];
const service = [
  { value: 1, label: "Крутой" },
  { value: 2, label: "Балдежный" },
  { value: 3, label: "Чилловый" },
  { value: 4, label: "Пивной" },
  { value: 5, label: "Пятничный" },
  { value: 6, label: "Пудж" },
  { value: 7, label: "ФредиФасбер" },
];
</script>

<template>
  <AuthenticatedLayout>
    <VerticalForm header="Город" sbm="Отправить" :handleSubmit="onSubmit">
      <StringInput
        label="Фамилия"
        name="last_name"
        :value="form.last_name"
        @update:value="(val) => (form.last_name = val)"
        autocomplete="current-name"
      />
      <StringInput
        label="Имя"
        name="first_name"
        :value="form.first_name"
        @update:value="(val) => (form.first_name = val)"
        autocomplete="current-name"
      />
      <StringInput
        label="Отчество"
        name="middle_name"
        :value="form.middle_name"
        @update:value="(val) => (form.middle_name = val)"
        autocomplete="current-name"
      />
      <StringInput
        label="Email"
        name="email"
        :value="form.email"
        @update:value="(val) => (form.email = val)"
        autocomplete="current-name"
      />
      <StringInput
        label="Телефон"
        name="phone"
        :value="form.phone"
        @update:value="(val) => (form.phone = val)"
        autocomplete="current-name"
      />
      <Select
        label="Подразделение"
        name="division_id"
        v-model="form.division_id"
        :options="division"
      />
      <Select
        label="Услуга"
        name="service_id"
        v-model="form.service_id"
        :options="service"
      />
    </VerticalForm>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, watch } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { VerticalForm, StringInput, Select } from "@components";

const subscribes = usePage().props.subscribe.data;

const form = useForm({
  last_name: subscribes.last_name,
  first_name: subscribes.first_name,
  middle_name: subscribes.middle_name,
  email: subscribes.email,
  phone: subscribes.phone,
  division_id: subscribes.division_id,
  service_id: subscribes.service_id,
});

const rawPhone = ref("");

function onSubmit(e) {
  e.preventDefault();

  form.put(route("subscribes.update", { subscribe: subscribes.id }));
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

function formatPhone(value) {
  let digits = value.replace(/\D/g, "");
  if (digits.length > 0) digits = "7" + digits.slice(1);

  let res = "";
  if (digits.length > 0) res = "+" + digits[0];
  if (digits.length > 1) res += " (" + digits.slice(1, 4);
  if (digits.length >= 4) res += ")";
  if (digits.length > 4) res += " " + digits.slice(4, 7);
  if (digits.length >= 7) res += "-" + digits.slice(7, 9);
  if (digits.length >= 9) res += "-" + digits.slice(9, 11);
  return res;
}

watch(rawPhone, (v) => {
  form.value.phone = formatPhone(v);
});

function onKeyDown(e) {
  const allowedKeys = ["Backspace", "Delete"];

  if (allowedKeys.includes(e.key) || (/^\d$/.test(e.key) && rawPhone.value.length < 11)) {
    return;
  }
  e.preventDefault();
}

function onUpdateValue(val) {
  rawPhone.value = val.replace(/\D/g, "");
}
</script>

<template>
  <AuthenticatedLayout>
    <VerticalForm header="Город" sbm="Сохранить" :handleSubmit="onSubmit">
      <StringInput
        label="Фамилия"
        name="last_name"
        :value="form.last_name"
        @update:value="(val) => (form.last_name = val)"
        autocomplete="current-last_name"
      />
      <StringInput
        label="Имя"
        name="first_name"
        :value="form.first_name"
        @update:value="(val) => (form.first_name = val)"
        autocomplete="current-first_name"
      />
      <StringInput
        label="Отчество"
        name="middle_name"
        :value="form.middle_name"
        @update:value="(val) => (form.middle_name = val)"
        autocomplete="current-middle_name"
      />
      <StringInput
        label="Email"
        name="email"
        :value="form.email"
        @update:value="(val) => (form.email = val)"
        autocomplete="current-email"
      />
      <StringInput
        label="Телефон"
        name="phone"
        :value="form.phone"
        @update:value="onUpdateValue"
        @keydown="onKeyDown"
        autocomplete="current-phone"
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

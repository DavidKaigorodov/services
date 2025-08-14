<script setup>
import { computed } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import {
  HorizontalForm,
  FormGroup,
  StringInput,
  Select,
  WorkSchedule,
  TextArea,
} from "@components";

const cities = usePage().props.cities;

const form = useForm({
  name: "",
  adres: "",
  city_id: "",
  work: {
    mon: { date_start: "", date_end: "" },
    tue: { date_start: "", date_end: "" },
    wed: { date_start: "", date_end: "" },
    thu: { date_start: "", date_end: "" },
    fri: { date_start: "", date_end: "" },
    sat: { date_start: "", date_end: "" },
    sun: { date_start: "", date_end: "" },
  },
  responsible_name: "",
  responsible_email: "",
  responsible_password: "",
});

const cityOptions = computed(() => {
  return Object.entries(cities).map(([id, cityData]) => ({
    value: id,
    label: cityData.name,
  }));
});

function onSubmit(e) {
  e.preventDefault();

  form.post(route("divisions.store"));
}
</script>

<template>
  <AuthenticatedLayout>
    <HorizontalForm header="Организации" sbm="Отправить" :handleSubmit="onSubmit">
      <FormGroup name="organization" label="Информация об организации">
        <TextArea
          label="Наименование"
          name="name"
          :value="form.name"
          @update:value="(val) => (form.name = val)"
          :rows="4"
        />
        <TextArea
          label="Адрес"
          name="address"
          :value="form.address"
          @update:value="(val) => (form.adres = val)"
          autocomplete="current-adres"
          :rows="6"
        />
        <Select
          label="Город"
          name="city_id"
          v-model="form.city_id"
          :options="cityOptions"
          placeholder="Выберите город"
        />
      </FormGroup>

      <FormGroup name="work" label="График работы">
        <WorkSchedule header="График работы" v-model="form.work" name="work" />
      </FormGroup>

      <FormGroup name="responsible" label="Ответственное лицо">
        <StringInput
          label="Имя"
          name="responsible_name"
          :value="form.responsible_name"
          @update:value="(val) => (form.responsible_name = val)"
          autocomplete="current-responsible-name"
        />
        <StringInput
          label="Email"
          name="responsible_email"
          :value="form.responsible_email"
          @update:value="(val) => (form.responsible_email = val)"
          autocomplete="current-responsible-email"
        />
        <StringInput
          label="Пароль"
          type="password"
          name="responsible_password"
          :value="form.responsible_password"
          @update:value="(val) => (form.responsible_password = val)"
          autocomplete="current-responsible-passsword"
        />
      </FormGroup>
    </HorizontalForm>
  </AuthenticatedLayout>
</template>

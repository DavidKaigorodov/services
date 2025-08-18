<script setup>
import { computed } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import {
  HorizontalForm,
  FormGroup,
  StringInput,
  Select,
  WorkSchedule,
  TextArea,
} from "@components";

const division = usePage().props.division.data;
const cities = usePage().props.cities;

const form = useForm({
  name: division.name,
  address: division.address,
  city_id: division.city.id,
  work: {
    mon: { date_start: "", date_end: "", is_working: "true" },
    tue: { date_start: "", date_end: "", is_working: "false" },
    wed: { date_start: "", date_end: "", is_working: "false" },
    thu: { date_start: "", date_end: "", is_working: "true" },
    fri: { date_start: "", date_end: "", is_working: "" },
    sat: { date_start: "", date_end: "", is_working: "" },
    sun: { date_start: "", date_end: "", is_working: "" },
  },
  responsible_name: "",
  responsible_email: "",
  responsible_password: "",
});

const cityOptions = computed(() => {
  return cities.map((city) => ({
    value: city.id,
    label: city.name,
  }));
});

function onSubmit(e) {
  e.preventDefault();

  form.put(route("divisions.update", { division: division.id }));
}
</script>

<template>
  <AuthenticatedLayout>
    <HorizontalForm header="Организации" sbm="Сохранить" :handleSubmit="onSubmit">
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
          name="adres"
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
        <WorkSchedule v-model="form.work" name="work" />
      </FormGroup>
    </HorizontalForm>
  </AuthenticatedLayout>
</template>

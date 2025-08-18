<script setup>
import { ref, computed } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";
import { DivisionTab } from "@includes";

import { HorizontalForm, FormGroup, Select, WorkSchedule, TextArea } from "@components";

const division = usePage().props.division.data;
const cities = usePage().props.cities;

const form = useForm({
  name: division.name,
  address: division.address,
  city_id: division.city.id,
  work: {
    mon: { date_start: "", date_end: "" },
    tue: { date_start: "", date_end: "" },
    wed: { date_start: "", date_end: "" },
    thu: { date_start: "", date_end: "" },
    fri: { date_start: "", date_end: "" },
    sat: { date_start: "", date_end: "" },
    sun: { date_start: "", date_end: "" },
  },
});

const cityOptions = computed(() => {
  return cities.map((city) => ({
    value: city.id,
    label: city.name,
  }));
});

const isEditing = ref(false);

function onSubmit(e) {
  e.preventDefault();

  if (!isEditing.value) {
    isEditing.value = true;
    return;
  }

  form.put(route("divisions.update", { division: division.id }), {
    onSuccess: () => {
      isEditing.value = false;
    },
  });
}
</script>

<template>
  <AuthenticatedLayout>
    <DivisionTab>
      <HorizontalForm
        header="Общая информация"
        :sbm="isEditing ? 'Сохранить' : 'Редактировать'"
        :handleSubmit="onSubmit"
      >
        <FormGroup name="organization" label="Информация об организации">
          <TextArea
            label="Наименование"
            name="name"
            :value="form.name"
            @update:value="(val) => (form.name = val)"
            :rows="4"
            :disabled="!isEditing"
          />
          <TextArea
            label="Адрес"
            name="address"
            :value="form.address"
            @update:value="(val) => (form.address = val)"
            autocomplete="current-address"
            :rows="6"
            :disabled="!isEditing"
          />
          <Select
            label="Город"
            name="city_id"
            v-model="form.city_id"
            :options="cityOptions"
            placeholder="Выберите город"
            :disabled="!isEditing"
          />
        </FormGroup>

        <FormGroup name="work" label="График работы">
          <WorkSchedule v-model="form.work" name="work" :disabled="!isEditing" />
        </FormGroup>
      </HorizontalForm>
    </DivisionTab>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import VerticalForm from "../../components/forms/VerticalForm.vue";

import DatePicker from "../../components/inputs/datePicker/DatePicker.vue";
import Select from "../../components/forms/inputs/select/Select.vue";
import TextArea from "../../components/inputs/TextArea.vue";

const services = usePage().props.services.data;

const form = ref({
  name: services.name,
  duration: services.duration,
  user: services.user,
});

function onSubmit() {
  e.preventDefault();

  put(route("service.update", { service: services.id }), form);
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
      <Select :options="[123]" name="user" label="Специалист" />
    </VerticalForm>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";

import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

import VerticalForm from "../../components/forms/VerticalForm.vue";

import StringInput from "../../components/forms/inputs/StringInput.vue";
import DatePicker from "../../components/inputs/datePicker/DatePicker.vue";
import Select from "../../components/forms/inputs/select/Select.vue";

const form = ref({
  name: "",
  duration: "",
  user: "",
});

function onSubmit() {
  e.preventDefault();

  put(route("service.store"), form);
}
</script>

<template>
  <AuthenticatedLayout>
    <VerticalForm header="Услуги" sbm="Отправить" :handleSubmit="onSubmit">
      <StringInput
        label="Наименование"
        name="name"
        :value="form.name"
        @update:value="(val) => (form.name = val)"
        autocomplete="current-name"
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

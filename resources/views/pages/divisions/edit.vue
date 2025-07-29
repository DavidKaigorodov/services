<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";
import VerticalForm from "../../components/forms/VerticalForm.vue";
import StringInput from "../../components/forms/inputs/StringInput.vue";
import Select from "../../components/forms/inputs/select/Select.vue";
import WorkSchedule from "../../components/forms/inputs/WorkSchedule.vue";
import Label from "../../components/forms/Label.vue";
import FormGroup from "../../components/forms/FormGroup.vue";

const form = ref({
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

const cities = [
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
        <VerticalForm header="Организации" sbm="Отправить">
            <FormGroup name="organization" label="Информация об организации">
                <StringInput
                    label="Наименование"
                    name="name"
                    :value="form.name"
                    @update:value="(val) => (form.name = val)"
                    autocomplete="current-name"
                />
                <StringInput
                    label="Адрес"
                    name="adres"
                    :value="form.adres"
                    @update:value="(val) => (form.adres = val)"
                    autocomplete="current-adres"
                />
                <Select
                    label="Город"
                    name="city_id"
                    v-model="form.city_id"
                    :options="cities"
                    placeholder="Выберите город"
                />
            </FormGroup>

            <FormGroup name="work" label="График работы">
                <WorkSchedule
                    header="График работы"
                    v-model="form.work"
                    name="work"
                />
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
                    name="responsible_password"
                    :value="form.responsible_password"
                    @update:value="(val) => (form.responsible_password = val)"
                    autocomplete="current-responsible-passsword"
                />
            </FormGroup>
        </VerticalForm>
    </AuthenticatedLayout>
</template>

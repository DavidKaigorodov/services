<script>
import { usePage, useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import { HorizontalForm, FormGroup, Select, WorkSchedule, TextArea } from "@components";

export default {
    components: {
        AuthenticatedLayout,
        HorizontalForm,
        FormGroup,
        Select,
        WorkSchedule,
        TextArea,
    },

    data() {
        const division = usePage().props.division.data;
        const cities = usePage().props.cities;
        return {
            form: useForm({
                name: division.name,
                address: division.address,
                city_id: division.city.id,
                shedules: division.shedules,
                responsible_name: "",
                responsible_email: "",
                responsible_password: "",
            }),
            cities,
            division,
        };
    },

    computed: {
        cityOptions() {
            return this.cities.map((city) => ({
                value: city.id,
                label: city.name,
            }));
        },
    },

    methods: {
        onSubmit(e) {
            e.preventDefault();
            this.form.put(route("divisions.update", { division: this.division.id }));
        },
    },
};
</script>

<template>
    <AuthenticatedLayout>
        <HorizontalForm
            header="Организации"
            sbm="Сохранить"
            :handleSubmit="onSubmit"
        >
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
                <WorkSchedule v-model="form.shedules" name="shedules" />
            </FormGroup>
        </HorizontalForm>
    </AuthenticatedLayout>
</template>

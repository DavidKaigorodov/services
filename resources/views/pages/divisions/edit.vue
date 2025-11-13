<script>
import { usePage, useForm } from "@inertiajs/vue3";

import { AuthenticatedLayout } from "@layouts";

import {
    HorizontalForm,
    FormGroup,
    Select,
    WorkSchedule,
    TextArea,
    StringInput,
} from "@components";

export default {
    components: {
        AuthenticatedLayout,
        HorizontalForm,
        FormGroup,
        Select,
        WorkSchedule,
        TextArea,
        StringInput,
    },

    data() {
        const division = usePage().props.division.data;
        const divisions = usePage().props.divisions;
        const cities = usePage().props.cities;
        return {
            form: useForm({
                name: division.name,
                address: division.address,
                city_id: division.city.id,
                shedules: division.shedules,
                parent_id: division.parent.id,
                url: division.url,
            }),
            cities,
            division,
            divisions,
        };
    },

    computed: {
        cityOptions() {
            return this.cities.map((city) => ({
                value: city.id,
                label: city.name,
            }));
        },
        divisionOption() {
            return this.divisions.map((division) => ({
                value: division.id,
                label: division.name,
            }));
        },
    },

    methods: {
        onSubmit(e) {
            e.preventDefault();
            this.form.put(
                route("divisions.update", { division: this.division.id }),
            );
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
                <Select
                    label="Главное подразделение"
                    name="parent_id"
                    v-model="form.parent_id"
                    :options="divisionOption"
                    placeholder="Выберите главное подразделение"
                />
                <StringInput
                    label="Ссылка"
                    name="url"
                    :value="form.url"
                    placeholder="http://example.ru"
                    @update:value="(val) => (form.url = val)"
                    autocomplete="url"
                />
            </FormGroup>
            <FormGroup name="work" label="График работы">
                <WorkSchedule v-model="form.shedules" name="shedules" />
            </FormGroup>
        </HorizontalForm>
    </AuthenticatedLayout>
</template>

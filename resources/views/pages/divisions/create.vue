<script>
import { useForm, usePage } from "@inertiajs/vue3";

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
        return {
            cities: usePage().props.cities,
            form: useForm({
                name: "",
                address: "",
                city_id: "",
                shedules: {},
            }),
        };
    },

    computed: {
        cityOptions() {
            return Object.entries(this.cities).map(([id, cityData]) => ({
                value: id,
                label: cityData.name,
            }));
        },
    },

    methods: {
        onSubmit(e) {
            e.preventDefault();
            this.form.post(route("divisions.store"));
        },
    },
};
</script>

<template>
    <AuthenticatedLayout>
        <HorizontalForm
            header="Организации"
            sbm="Отправить"
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
                    name="address"
                    :value="form.address"
                    @update:value="(val) => (form.address = val)"
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
                <WorkSchedule
                    header="График работы"
                    v-model="form.shedules"
                    name="shedules"
                />
            </FormGroup>
        </HorizontalForm>
    </AuthenticatedLayout>
</template>

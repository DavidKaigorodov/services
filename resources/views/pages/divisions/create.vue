<script>
import { useForm, usePage } from "@inertiajs/vue3";

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
        const divisions = usePage().props.divisions;
        return {
            cities: usePage().props.cities,
            form: useForm({
                name: "",
                address: "",
                city_id: "",
                shedules: {},
                parent_id: "",
                url: "",
            }),
            divisions,
        };
    },

    computed: {
        cityOptions() {
            return Object.entries(this.cities).map(([id, cityData]) => ({
                value: cityData.id,
                label: cityData.name,
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
                <WorkSchedule
                    header="График работы"
                    v-model="form.shedules"
                    name="shedules"
                />
            </FormGroup>
        </HorizontalForm>
    </AuthenticatedLayout>
</template>

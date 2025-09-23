<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { DivisionTab } from "@includes";
import { AuthenticatedLayout } from "@layouts";
import {
    HorizontalForm,
    WorkSchedule,
    FormGroup,
    StringInput,
    Table,
    CheckBox,
} from "@components";

const worker = usePage().props.worker.data;
const division = usePage().props.division.data;
const services = usePage().props.services;

const form = useForm({
    shedules: worker.shedules,
    name: worker.name,
    email: worker.email,
    service_ids: worker.services.map((service) => service.id),
    division_id: division.id,
});

function toggleCheckbox(row, val) {
    if (val) form.service_ids.push(row.id);
    else form.service_ids = form.service_ids.filter((el) => el !== row.id);
}

const columns = [
    { key: "name", label: "", width: "200px" },
    { key: "actions", label: "" },
];

function onSubmit(e) {
    e.preventDefault();

    form.put(route("workers.update", { worker: worker.id }));
}
</script>

<template>
    <AuthenticatedLayout>
        <DivisionTab current="workers">
            <HorizontalForm
                header="Информация о работнике"
                sbm="Сохранить"
                :handleSubmit="onSubmit"
            >
                <FormGroup name="info" label="Информация">
                    <StringInput
                        label="ФИО"
                        name="name"
                        :value="form.name"
                        disabled
                    />
                    <StringInput
                        label="Email"
                        name="email"
                        :value="form.email"
                        disabled
                    />
                </FormGroup>

                <FormGroup name="work" label="График работы">
                    <WorkSchedule
                        header="График работы"
                        v-model="form.shedules"
                        name="shedules"
                    />
                </FormGroup>
                <FormGroup name="services" label="Услуги">
                    <div class="services">
                        <Table
                            :data="services"
                            :columns="columns"
                            :head="false"
                            :toolbarVisible="false"
                        >
                            <template #actions="{ row }">
                                <CheckBox
                                    :modelValue="
                                        form.service_ids.includes(row.id)
                                    "
                                    @update:modelValue="
                                        (val) => toggleCheckbox(row, val)
                                    "
                                />
                            </template>
                        </Table>
                    </div>
                </FormGroup>
            </HorizontalForm>
        </DivisionTab>
    </AuthenticatedLayout>
</template>

<style lang="sass">
.services
    // max-height: 605px
    overflow-y: auto
    @include scroll()
</style>

<script setup>

import { default as DatePicker } from './datePicker/DatePicker.vue'
import { default as CheckBox } from './CheckBox.vue'
import { default as FormItem } from '../FormItem.vue'

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
    },
    name: String,
    disabled: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const updateDay = (day, key, value) => {
    emit("update:modelValue", {
        ...props.modelValue,
        [day]: {
            ...props.modelValue[day],
            [key]: value,
        },
    });
};

const toggleDay = (day, val) => {
    const newValue = { ...props.modelValue };

    if (val) {
        if (!newValue[day]) {
            newValue[day] = {
                date_start: null,
                date_end: null,
            };
        }
    } else {
        delete newValue[day];
    }

    emit("update:modelValue", newValue);
};

const days = [
    { key: "mon", label: "Пн" },
    { key: "tue", label: "Вт" },
    { key: "wed", label: "Ср" },
    { key: "thu", label: "Чт" },
    { key: "fri", label: "Пт" },
    { key: "sat", label: "Сб" },
    { key: "sun", label: "Вс" },
];
</script>

<template>
    <FormItem name="shedules">
    <div class="work-schedule-time">
        <div v-for="day in days" :key="day.key" class="day-row">
            <span class="day-label">{{ day.label }}:</span>

            <CheckBox
                :modelValue="day.key in modelValue"
                @update:modelValue="(val) => toggleDay(day.key, val)"
                :disabled="disabled"
            />

            <div v-if="day.key in modelValue" class="time-picker-block">
                <DatePicker
                    mode="time"
                    :modelValue="modelValue[day.key]?.date_start"
                    @update:modelValue="
                        (val) => updateDay(day.key, 'date_start', val)
                    "
                    :name="`${name}[${day.key}][date_start]`"
                    :disabled="disabled"
                    :label="''"
                />
                <DatePicker
                    mode="time"
                    :modelValue="modelValue[day.key]?.date_end"
                    @update:modelValue="
                        (val) => updateDay(day.key, 'date_end', val)
                    "
                    :name="`${name}[${day.key}][date_end]`"
                    :disabled="disabled"
                    :label="''"
                />
                <span
                    v-if="
                        !modelValue[day.key]?.date_start ||
                        !modelValue[day.key]?.date_end
                    "
                    class="error-message"
                >
                    *
                </span>
            </div>
        </div>
    </div>
    </FormItem>
</template>

<style lang="sass">
.work-schedule-time
    display: flex
    flex-direction: column
    gap: 10px

    .day-row
        display: flex
        align-items: center
        gap: 10px
        height: 30px

        .day-label
            width: 30px
            align-items: center

    .time-picker-block
        display: flex
        align-items: center
        gap: 6px

    .error-message
        color: red
        font-size: 12px
        align-self: center
</style>

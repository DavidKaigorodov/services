<script>
import { default as DatePicker } from "./datePicker/DatePicker.vue";
import { default as CheckBox } from "./CheckBox.vue";
import { default as FormItem } from "../FormItem.vue";

export default {
    components: {
        DatePicker,
        CheckBox,
        FormItem,
    },

    props: {
        modelValue: {
            type: Object,
            required: true,
        },
        name: String,
        disabled: {
            type: Boolean,
            default: false,
        },
    },

    emits: ["update:modelValue"],

    data() {
        return {
            days: [
                { key: "mon", label: "Пн" },
                { key: "tue", label: "Вт" },
                { key: "wed", label: "Ср" },
                { key: "thu", label: "Чт" },
                { key: "fri", label: "Пт" },
                { key: "sat", label: "Сб" },
                { key: "sun", label: "Вс" },
            ],
        };
    },

    methods: {
        updateDay(day, key, value) {
            this.$emit("update:modelValue", {
                ...this.modelValue,
                [day]: {
                    ...this.modelValue[day],
                    [key]: value,
                },
            });
        },
        toggleDay(day, val) {
            const newValue = { ...this.modelValue };

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

            this.$emit("update:modelValue", newValue);
        },
    },
};
</script>

<template>
    <FormItem name="shedules">
        <div class="work-schedule-time">
            <div v-for="day in days" :key="day.key" class="day-row-container">
                <div class="day-row">
                    <span class="day-label"> {{ day.label }}: </span>

                    <CheckBox
                        :modelValue="day.key in modelValue"
                        @update:modelValue="(val) => toggleDay(day.key, val)"
                        :disabled="disabled"
                    />

                    <div v-if="day.key in modelValue" class="time-picker-block">
                        <div class="datepicker-wrapper-relative">
                            <DatePicker
                                mode="time"
                                :modelValue="modelValue[day.key]?.date_start"
                                @update:modelValue="
                                    (val) =>
                                        updateDay(day.key, 'date_start', val)
                                "
                                :name="`${name}[${day.key}][date_start]`"
                                :disabled="disabled"
                                :label="''"
                            />
                        </div>

                        <div class="datepicker-wrapper-relative">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FormItem>
</template>

<style lang="sass">
.work
    width: 700px

.work-schedule-time
    display: flex
    flex-direction: column

    .day-row-container
        display: flex
        align-items: center
        padding: 8px 0
        box-sizing: border-box

        .day-row
            display: flex
            align-items: center
            gap: 10px
            flex: 1

            .day-label
                width: 30px
                flex-shrink: 0
                font-weight: 500

            .time-picker-block
                display: flex
                align-items: center
                gap: 12px

                .datepicker-wrapper-relative
                    position: relative
                    max-width: 280px
</style>

<script setup>
import FormGroup from "../FormGroup.vue";
import Label from "../Label.vue";

const props = defineProps({
    modelValue: Object,
    name: String,
    label: String,
    placeholderStart: {
        type: String,
        default: "Начало",
    },
    placeholderEnd: {
        type: String,
        default: "Окончание",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const updateStart = (value) => {
    emit("update:modelValue", {
        ...props.modelValue,
        date_start: value,
    });
};

const updateEnd = (value) => {
    emit("update:modelValue", {
        ...props.modelValue,
        date_end: value,
    });
};
</script>

<template>
    <FormGroup :name="name" class="time-input-wrapper">
        <div class="time-input-container">
            <Label :labelText="label" class="time-input-label" />
            <div class="time-range" :class="{ 'is-disabled': disabled }">
                <input
                    type="time"
                    :value="modelValue.date_start"
                    @input="updateStart($event.target.value)"
                    :placeholder="placeholderStart"
                    :disabled="disabled"
                    class="time-input"
                />
                <span class="time-separator">—</span>
                <input
                    type="time"
                    :value="modelValue.date_end"
                    @input="updateEnd($event.target.value)"
                    :placeholder="placeholderEnd"
                    :disabled="disabled"
                    class="time-input"
                />
            </div>
        </div>

        <input
            type="hidden"
            :name="`${name}[date_start]`"
            :value="modelValue.date_start"
            v-if="name"
        />
        <input
            type="hidden"
            :name="`${name}[date_end]`"
            :value="modelValue.date_end"
            v-if="name"
        />
    </FormGroup>
</template>


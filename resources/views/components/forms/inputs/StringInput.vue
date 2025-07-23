<script setup>
import FormGroup from "../FormGroup.vue";
import Label from "../Label.vue";

const props = defineProps({
    type: {
        type: String,
        default: "text",
    },
    value: {
        type: [String, Number, null],
        default: "",
    },
    placeholder: {
        type: String,
        default: "",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    autocomplete: {
        type: String,
        default: "",
    },
    id: {
        type: String,
        default: null,
    },
    name: String,
    label: String,
});

const inputId = props.id ?? props.name;
const placeholderText = props.placeholder ?? "";
</script>

<template>
    <FormGroup :name="name">
        <Label :labelText="label"/>
        <input
            :type="type"
            :id="inputId"
            :name="name"
            :value="value ?? ''"
            @input="$emit('update:value', $event.target.value)"
            :placeholder="placeholderText"
            :disabled="disabled"
            :autocomplete="autocomplete"
        />
    </FormGroup>
</template>

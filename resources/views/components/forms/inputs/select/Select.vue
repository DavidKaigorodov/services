<script setup>
import { ref, computed } from "vue";
import FormGroup from "../../FormGroup.vue";
import Label from "../../Label.vue";
import SelectInput from "./SelectInput.vue";
import SelectList from "./SelectList.vue";

const props = defineProps({
    modelValue: [String, Number],
    options: {
        type: Array,
        required: true,
    },
    label: String,
    name: String,
    disabled: Boolean,
    placeholder: String,
});

const emit = defineEmits(["update:modelValue"]);

const isOpen = ref(false);
const selectWrapper = ref(null);

const selectedLabel = computed(() => {
    const selectOption = props.options.find(
        (key) => key.value === props.modelValue
    );
    return selectOption ? selectOption.label : "";
});

const toggleDropdown = (event) => {
    event.stopPropagation();
    if (!props.disabled) isOpen.value = !isOpen.value;
};

const closeDropdown = () => {
    isOpen.value = false;
};

const selectOption = (option) => {
    emit("update:modelValue", option.value);
    isOpen.value = false;
};

const handleClickOutside = (event) => {
    if (selectWrapper.value && !selectWrapper.value.contains(event.target)) {
        closeDropdown();
    }
};

document.addEventListener("click", handleClickOutside);
</script>

<template>
    <FormGroup :name="name">
        <Label :labelText="label" />
        <div
            ref="selectWrapper"
            class="select-wrapper"
            :class="{ 'is-disabled': disabled }"
            @click="toggleDropdown"
        >
            <SelectInput
                :selected-label="selectedLabel"
                :placeholder="placeholder"
                :is-open="isOpen"
                :disabled="disabled"
            />
            <SelectList
                v-show="isOpen"
                :options="options"
                :model-value="modelValue"
                :on-select="selectOption"
            />
        </div>

        <input type="hidden" :name="name" :value="modelValue" v-if="name" />
    </FormGroup>
</template>

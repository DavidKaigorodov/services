<script>
import CalendarPopup from "./CalendarPopup.vue";
import TimePickerPopup from "./TimePickerPopup.vue";
import DateInput from "./DateInput.vue";
import Label from "../../Label.vue";
import FormItem from "../../FormItem.vue";
import { formatDate } from "./utils";

export default {
    components: {
        CalendarPopup,
        TimePickerPopup,
        DateInput,
        Label,
        FormItem,
    },

    props: {
        modelValue: {
            type: [String, Object, Number],
            default: null,
        },
        name: String,
        label: String,
        mode: {
            type: String,
            default: "date",
            validator: (value) => ["date", "time"].includes(value),
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },

    emits: ["update:modelValue"],

    data() {
        return {
            show: false,
        };
    },

    computed: {
        formattedValue() {
            if (!this.modelValue) return "";
            return this.mode === "date"
                ? formatDate(this.modelValue, "DD.MM.YYYY")
                : this.modelValue;
        },
        popupStyles() {
            if (!this.show || !this.$refs.wrapperRef) return {};
            const rect = this.$refs.wrapperRef.getBoundingClientRect();
            return {
                position: "absolute",
                left: `${rect.left}px`,
                top: `${rect.bottom + window.scrollY}px`,
                zIndex: "10000",
                width: `${rect.width}px`,
            };
        },
        currentPopup() {
            return this.mode === "time" ? TimePickerPopup : CalendarPopup;
        },
    },

    methods: {
        togglePopup() {
            if (this.disabled) return;
            this.show = !this.show;
        },
        updateValue(val) {
            this.$emit("update:modelValue", val);
        },
        handleClose() {
            this.show = false;
        },
        handleClickOutside(event) {
            const wrapper = this.$refs.wrapperRef;
            const popup = event.target.closest(".calendar-popup");
            if (wrapper?.contains(event.target) || popup) return;
            this.show = false;
        },
    },
    mounted() {
        document.addEventListener("click", this.handleClickOutside);
    },
    beforeUnmount() {
        document.removeEventListener("click", this.handleClickOutside);
    },
};
</script>

<template>
    <FormItem :name="name">
        <Label v-if="label !== ''" :labelText="label" />
        <div class="datepicker-wrapper" ref="wrapperRef">
            <DateInput
                :modelValue="formattedValue"
                @toggle="togglePopup"
                :disabled="disabled"
                v-bind="$attrs"
            />
            <Teleport to="body">
                <component
                    :is="currentPopup"
                    v-if="show"
                    :modelValue="modelValue"
                    @update:modelValue="updateValue"
                    @close="handleClose"
                    class="calendar-popup"
                    :style="popupStyles"
                />
            </Teleport>
        </div>
    </FormItem>
</template>

<style lang="sass" scoped>
.datepicker-wrapper
    position: relative
    display: inline-block
</style>

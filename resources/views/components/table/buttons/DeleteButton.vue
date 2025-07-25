<script setup>
import { router } from "@inertiajs/vue3";
import RedButton from "../../buttons/RedButton.vue";
import TrashIco from "../../icons/TrashIco.vue";

const props = defineProps({
    href: String,
});

const href = props.href;

function destroy() {
    if (confirm("Вы уверены что хотите удалить запись?")) router.delete(href);
}
</script>
<template>
    <RedButton @click="destroy">
        <TrashIco />
    </RedButton>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import PlusIco from "../../icons/PlusIco.vue";

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="href" class="button blue-button" v-bind="$attrs">
        <PlusIco />
    </Link>
</template>

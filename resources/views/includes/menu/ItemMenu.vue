<script setup>
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    label: String,
});
function goto(e) {
    e.preventDefault();

    router.get(props.href);
}
</script>

<template>
    <li>
        <Link @click="goto" v-bind="$attrs">
            {{ label }}
        </Link>
    </li>
</template>

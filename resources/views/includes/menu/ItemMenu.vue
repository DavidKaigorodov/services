<script setup>
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
    },
    label: String,
    params: {
        type: Object,
    },
    method: {
        type: String,
    },
});

function goto(e) {
    e.preventDefault();

    if (props.method === "post") router.post(route(props.href, props.params));
    else router.get(route(props.href, props.params));
}
</script>

<template>
    <li>
        <Link :href="props.href" @click="goto" v-bind="$attrs">
            {{ label }}
        </Link>
    </li>
</template>
<style lang="sass" scoped>
.sidebar-link
    display: block
    padding: 5px 10px
    color: white
    text-decoration: none
    border-radius: 8px
    transition: all 0.2s ease
    font-size: 1rem

    &:hover
        background: var(--blue-button-background-color-hover)
        color: white

.logout
    display: block
    padding: 5px 10px
    font-weight: bold
    color: white
    text-decoration: none
    border-radius: 8px
    transition: all 0.2s ease
    font-size: 1.1rem

    &:hover
        background: var(--blue-button-background-color-hover)
        color: white
</style>

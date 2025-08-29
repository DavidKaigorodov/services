<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
    params: {
        type: Object,
    },
    method: {
        type: String,
        default: "get",
    },
    name: {
        type: String,
    },
});
</script>

<template>
    <li class="tab-item" :class="{ active: active }">
        <Link
            :href="route(href, params)"
            :method="method"
            :class="'tab-link ' + name"
        >
            {{ label }}
        </Link>
    </li>
</template>

<style lang="sass" scoped>
.tab-item
    list-style: none
    display: inline-block
    margin: 0 8px

    .tab-link
        display: inline-block
        padding: 10px 16px
        text-decoration: none
        color: #555
        border-radius: 6px 6px 0 0
        font-size: 14px
        transition: all 0.2s ease
        border-bottom: 3px solid transparent
        background: none
        border: none

        &:hover
            color: var(--palette-color-4)
            cursor: pointer

    .tab-logout
        color:#e2788c
        &:hover
            color:#e2788c

.tab-item.active .tab-link
    color: var(--palette-color-4)
    font-weight: 600
    border-bottom: 3px solid var(--palette-color-4)
</style>

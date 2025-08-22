<script setup>
import { Link } from "@inertiajs/vue3";

import { ChevronRightIco, ChevronLeftIco } from "@components";

const props = defineProps({
    total: {
        type: Number,
        required: true,
    },
    current: {
        type: Number,
        required: true,
    },
    perPage: {
        type: Number,
        required: true,
    },
});

const last = Math.ceil(props.total / props.perPage);

const href = (page) => {
    const url = new URL(location.href);
    url.searchParams.set("page", page);
    return url.toString();
};
</script>

<template>
    <div v-if="last > 1" class="pagination-container">
        <Link
            v-if="current > 1"
            :href="href(current - 1)"
            class="pagination-arrow prev"
        >
            <ChevronLeftIco />
        </Link>
        <Link v-if="current > 1" :href="href(1)" class="pagination-item"
            >1</Link
        >

        <span v-if="current > 3" class="pagination-ellipsis">...</span>

        <Link
            v-if="current - 1 > 1"
            :href="href(current - 1)"
            class="pagination-item"
        >
            {{ current - 1 }}
        </Link>

        <span class="pagination-item active">{{ current }}</span>

        <Link
            v-if="current + 1 < last"
            :href="href(current + 1)"
            class="pagination-item"
        >
            {{ current + 1 }}
        </Link>

        <span v-if="current + 2 < last" class="pagination-ellipsis">...</span>

        <Link v-if="current < last" :href="href(last)" class="pagination-item">
            {{ last }}
        </Link>

        <Link
            v-if="current < last"
            :href="href(current + 1)"
            class="pagination-arrow next"
        >
            <ChevronRightIco />
        </Link>
    </div>
</template>

<script setup>
import BaseLayout from "./BaseLayout.vue";
import Menu from "../includes/menu/Menu.vue";
import { usePage } from "@inertiajs/vue3";
let worker = "";
if (
    ["division_worker", "division_admin"].includes(
        usePage().props.current_user.data.role.code,
    )
)
    worker = "worker";
</script>
<template>
    <BaseLayout name="authenticated-layout">
        <Menu
            v-if="
                ['admin'].includes(usePage().props.current_user.data.role.code)
            "
        />
        <main :class="'main-content-' + worker">
            <slot />
        </main>
    </BaseLayout>
</template>

<style lang="sass" scoped>
.authenticated-layout
    display: flex
    min-height: 100vh
    background: #ffffffff

.main-content-
    margin-left: 250px
    flex: 1
    padding: 0px
    min-height: 100vh
    background: #ffffffff
    &worker
        flex: 1
        padding: 0px
        justify-content: center
        background: #ffffffff
</style>

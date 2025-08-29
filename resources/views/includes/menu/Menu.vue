<script setup>
import { ItemMenu } from "@includes";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props.current_user.data;
</script>

<template>
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Навигационная панель</h3>
        </div>

        <ul class="sidebar-menu">
            <ItemMenu
                class="sidebar-link"
                href="divisions.index"
                label="Подразделения"
            />
            <ItemMenu class="sidebar-link" href="cities.index" label="Города" />
            <ItemMenu
                class="sidebar-link"
                href="services.index"
                label="Услуги"
            />
            <ItemMenu
                v-if="user.division !== null"
                :params="{ division: user.division.id }"
                class="sidebar-link"
                href="divisions.show"
                label="Общая информация"
            />
        </ul>

        <div class="sidebar-footer">
            <ItemMenu class="logout" href="logout" method="post" label="Выход" />
        </div>
    </nav>
</template>
<style lang="sass" scoped>
.sidebar
    width: 250px
    flex-shrink: 0
    background: var(--palette-color-4)
    color: #FFF
    padding: 20px
    height: 100vh
    position: fixed
    left: 0
    top: 0
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1)
    z-index: 10001
    display: flex
    flex-direction: column
    justify-content: flex-start

    &-header
        margin-bottom: 30px
        font-size: 1.5rem

    &-menu
        list-style: none
        padding: 0
        margin: 0
        flex-grow: 1

    &-footer
        margin-top: auto
</style>

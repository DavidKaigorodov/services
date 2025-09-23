<script>
import { usePage } from "@inertiajs/vue3";
import { default as ItemMenu } from "./ItemMenu.vue";
import { default as HomeIco } from "../../components/icons/HomeIco.vue";
import { default as BuildingsIco } from "../../components/icons/BuildingsIco.vue";
import { default as CollectionIco } from "../../components/icons/CollectionIco.vue";
import { default as LogoutIco } from "../../components/icons/LogoutIco.vue";

export default {
    components: {
        ItemMenu,
        HomeIco,
        BuildingsIco,
        CollectionIco,
        LogoutIco,
    },

    computed: {
        user_role() {
            return usePage().props.current_user.data.role.code;
        },
    },
};
</script>

<template>
    <nav class="sidebar">
        <ul class="sidebar-menu" v-if="['admin'].includes(user_role)">
            <ItemMenu href="divisions.index" label="Подразделения">
                <HomeIco />
            </ItemMenu>

            <ItemMenu href="cities.index" label="Города">
                <BuildingsIco />
            </ItemMenu>

            <ItemMenu href="services.index" label="Услуги">
                <CollectionIco />
            </ItemMenu>
        </ul>

        <div class="sidebar-footer">
            <ItemMenu href="logout" method="post" label="Выход">
                <LogoutIco />
            </ItemMenu>
        </div>
    </nav>
</template>

<style lang="sass" scoped>
.sidebar
    width: 50px
    background: var(--palette-color-4)
    color: #FFF
    display: flex
    flex-direction: column

    &-menu
        margin: 0
        padding: 8px 0
        list-style: none

    &-footer
        margin-top: auto
        padding-bottom: 8px
</style>

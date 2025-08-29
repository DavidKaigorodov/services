<script setup>
import { BaseButton } from "@components";
</script>

<template>
    <BaseButton className="blue-button" v-bind="$attrs">
        <slot />
    </BaseButton>
</template>

<style lang="sass" >
.blue-button
    background: var(--blue-button-background-color)
    &:hover
        background: var(--blue-button-background-color-hover)
</style>

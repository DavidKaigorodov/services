<script setup>
import EventCalendar from "../../components/calendar/EventCalendar.vue";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

const records = [
    {
        name: "Иванов",
        "2025-07-30": [
            { time: "09:15", service: { name: "Стрижка" } },
            { time: "12:23", service: { name: "Окрашивание" } },
            { time: "14:32", service: { name: "Укладка" } },
        ],
    },
    {
        name: "Петрова",
        "2025-07-30": [
            { time: "11:05", service: { name: "Маникюр" } },
            { time: "15:40", service: { name: "Педикюр" } },
        ],
    },
];
</script>

<template>
    <AuthenticatedLayout>
        <EventCalendar :records="records" />
    </AuthenticatedLayout>
</template>

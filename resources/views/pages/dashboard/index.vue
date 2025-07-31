<script setup>
import EventCalendar from "../../components/calendar/EventCalendar.vue";
import AuthenticatedLayout from "../../layouts/AuthenticatedLayout.vue";

const data = [
    {
        date_time: "2025-07-31 08:30:00",
        records: [],
    },
    {
        date_time: "2025-07-31 09:00:00",
        records: [
            {
                user: {
                    first_name: "Бандос",
                },
                subscribes: [
                    {
                        service: {
                            name: "Прикол",
                        },
                        duration: "01:41:00",
                        subscribe: {
                            first_name: "sigma",
                            start_at: "2025-07-31 09:14:00",
                        },
                        shift: (15 / 30) * 100,
                    },
                ],
            },
        ],
    },
    {
        date_time: "2025-07-31 09:30:00",
        records: [],
    },
    {
        date_time: "2025-07-31 10:00:00",
        records: [],
    },
    {
        date_time: "2025-07-31 10:30:00",
        records: [
            {
                user: {
                    first_name: "Антонио Бандерас",
                },
                subscribes: [
                    {
                        service: {
                            name: "Субсидия",
                        },
                        duration: "00:32:00",
                        subscribe: {
                            first_name: "sigma",
                            start_at: "2025-07-31 10:15:00",
                        },
                        shift: (15 / 30) * 100,
                    },
                ],
            },
        ],
    },
    {
        date_time: "2025-07-31 11:00:00",
        records: [],
    },
    {
        date_time: "2025-07-31 11:30:00",
        records: [
            {
                user: {
                    first_name: "Антонио Бандерас",
                },
                subscribes: [
                    {
                        service: {
                            name: "Мия мучо пучо",
                        },
                        duration: "00:32:00",
                        subscribe: {
                            first_name: "sigma",
                            start_at: "2025-07-31 11:12:00",
                        },
                        shift: (15 / 30) * 100,
                    },
                ],
            },
        ],
    },
    {
        date_time: "2025-07-31 12:00:00",
        records: [
            {
                user: {
                    first_name: "Антонио Бандерас",
                },
                subscribes: [
                    {
                        service: {
                            name: "Субсидия",
                        },
                        duration: "00:32:00",
                        subscribe: {
                            first_name: "sigma",
                            start_at: "2025-07-31 12:15:00",
                        },
                        shift: (15 / 30) * 100,
                    },
                ],
            },
        ],
    },
    {
        date_time: "2025-07-31 12:30:00",
        records: [],
    },
    {
        date_time: "2025-07-31 13:00:00",
        records: [],
    },
    {
        date_time: "2025-07-31 13:30:00",
        records: [],
    },
    {
        date_time: "2025-07-31 14:00:00",
        records: [],
    },
    {
        date_time: "2025-07-31 14:30:00",
        records: [
            {
                user: {
                    first_name: "СигмаСигма Бой",
                },
                subscribes: [
                    {
                        service: {
                            name: "Тренер по дота 2 на мипо мид",
                        },
                        duration: "00:10:00",
                        subscribe: {
                            first_name: "sigma",
                            start_at: "2025-07-31 14:44:00",
                        },
                        shift: (14 / 30) * 100,
                    },
                ],
            },
        ],
    },
    {
        date_time: "2025-07-31 15:00:00",
        records: [],
    },
    {
        date_time: "2025-07-31 15:30:00",
        records: [],
    },
    {
        date_time: "2025-07-31 16:00:00",
        records: [],
    },
    {
        date_time: "2025-07-31 16:30:00",
        records: [],
    },
    {
        date_time: "2025-07-31 17:00:00",
        records: [],
    },
    {
        date_time: "2025-07-31 17:30:00",
        records: [],
    },
];
</script>

<template>
    <AuthenticatedLayout>
        <EventCalendar :records="data" />
    </AuthenticatedLayout>
</template>

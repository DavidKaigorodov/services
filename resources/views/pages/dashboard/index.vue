<script setup>
import { TimeLine } from "@components";
import { AuthenticatedLayout } from "@layouts";

const data = [
  {
    date: "2025-08-01",
    slots: [
      {
        date_time: "2025-08-01 08:30:00",
        records: [],
      },
      {
        date_time: "2025-08-01 09:00:00",
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
        date_time: "2025-08-01 09:30:00",
        records: [],
      },
      {
        date_time: "2025-08-01 10:00:00",
        records: [],
      },
      {
        date_time: "2025-08-01 10:30:00",
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
        date_time: "2025-08-01 11:00:00",
        records: [],
      },
      {
        date_time: "2025-08-01 11:30:00",
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
        date_time: "2025-08-01 12:00:00",
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
        date_time: "2025-08-01 12:30:00",
        records: [],
      },
      {
        date_time: "2025-08-01 13:00:00",
        records: [],
      },
      {
        date_time: "2025-08-01 13:30:00",
        records: [],
      },
      {
        date_time: "2025-08-01 14:00:00",
        records: [],
      },
      {
        date_time: "2025-08-01 14:30:00",
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
        date_time: "2025-08-01 15:00:00",
        records: [],
      },
      {
        date_time: "2025-08-01 15:30:00",
        records: [],
      },
      {
        date_time: "2025-08-01 16:00:00",
        records: [],
      },
      {
        date_time: "2025-08-01 16:30:00",
        records: [],
      },
      {
        date_time: "2025-08-01 17:00:00",
        records: [],
      },
      {
        date_time: "2025-08-01 17:30:00",
        records: [],
      },
    ],
  },
];
</script>

<template>
  <AuthenticatedLayout>
    <TimeLine header="Записи на прием" :records="data" />
  </AuthenticatedLayout>
</template>

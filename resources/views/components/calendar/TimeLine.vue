<script setup>
import { ref, computed } from "vue";
import dayjs from "dayjs";
import { router } from "@inertiajs/vue3";

import { BlueButton, DatePicker } from "@components";

const props = defineProps({
  records: Array,
  header: String,
});

const form = ref({
  date: "",
});

const todayDate = dayjs().format("YYYY-MM-DD");
const currentDate = ref(dayjs(props.selectedDate || todayDate));

const goToDate = (date) => {
  router.get("/132", {
    data: { date: date.format("YYYY-MM-DD") },
    preserveScroll: true,
  });
};

const goToPreviousDay = () => {
  goToDate(currentDate.value.subtract(1, "day"));
};

const goToNextDay = () => {
  goToDate(currentDate.value.add(1, "day"));
};

const goToToday = () => {
  goToDate(dayjs());
};

const allUsers = computed(() => {
  const users = props.records.flatMap((d) =>
    d.slots.flatMap((slot) => slot.records.map((r) => r.user.first_name))
  );
  return [...new Set(users)];
});

const durationToMinutes = (d) => {
  const [h, m, s] = d.split(":").map(Number);
  return h * 60 + m + s / 60;
};
setTimeout(() => {
  const blocks = document.getElementsByClassName("event-content");
  for (let i = 0; i < blocks.length; i++) {
    const block = blocks[i];
    if (block.scrollWidth > block.clientWidth) {
      block.innerText = "...";
    }
  }
}, 0);
</script>

<template>
  <div class="timeline-wrapper">
    <div class="timeline-grid">
      <div class="user-column">
        <div class="user-header-cell"></div>
        <div class="user-header-cell"></div>
        <div class="user-cell" v-for="user in allUsers" :key="user">
          {{ user }}
        </div>
      </div>

      <div class="days-wrapper">
        <div
          class="day-column"
          v-for="day in props.records"
          :key="day.date"
          :data-date="day.date"
        >
          <div class="time-cell header with-controls">
            <DatePicker v-model="form.date" label="" />
            <div class="header-title">{{ header }}</div>
            <div class="date-nav-buttons">
              <BlueButton class="nav-btn" @click="goToPreviousDay">←</BlueButton>
              <BlueButton class="nav-btn" @click="goToToday">Сегодня</BlueButton>
              <BlueButton class="nav-btn" @click="goToNextDay">→</BlueButton>
            </div>
          </div>

          <div class="time-row time-header">
            <div class="time-slot" v-for="slot in day.slots" :key="slot.date_time">
              {{ dayjs(slot.date_time).format("HH:mm") }}
            </div>
          </div>

          <div class="time-row" v-for="user in allUsers" :key="user">
            <div class="time-slot" v-for="slot in day.slots" :key="slot.date_time">
              <div class="events-track">
                <div
                  v-for="record in slot.records.filter((r) => r.user.first_name === user)"
                  :key="record.user.first_name + slot.date_time"
                >
                  <div
                    v-for="(sub, i) in record.subscribes"
                    :key="i"
                    class="event-block"
                    :style="{
                      left: sub.shift + '%',
                      width: (durationToMinutes(sub.duration) / 30) * 100 + '%',
                    }"
                    :title="`${sub.service.name} ${sub.subscribe.start_at.slice(11, 16)}`"
                  >
                    <div class="event-content">
                      {{ sub.service.name }}
                      {{ sub.subscribe.start_at.slice(11, 16) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

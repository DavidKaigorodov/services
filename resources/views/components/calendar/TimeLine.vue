<script setup>
import { ref, computed } from "vue";
import dayjs from "dayjs";
import { router } from "@inertiajs/vue3";

import { default as BlueButton } from '../buttons/BlueButton.vue'
import { default as DatePicker } from '../inputs/datePicker/DatePicker.vue'
import { default as ChevronRightIco } from '../icons/ChevronRightIco.vue';
import { default as ChevronLeftIco } from '../icons/ChevronLeftIco.vue';

const props = defineProps({
    records: Array,
    header: String,
    goto: Function,
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
        d.slots.flatMap((slot) => slot.records.map((r) => r.user.first_name)),
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
        <div class="timeline-header">
            <DatePicker v-model="form.date" label="" />
            <div class="header-title">
                {{ header }}
            </div>
            <div class="date-nav-buttons">
                <BlueButton class="nav-btn" @click="goToPreviousDay">
                    <ChevronLeftIco />
                </BlueButton>
                <BlueButton class="nav-btn" @click="goToToday"
                    >Сегодня</BlueButton
                >
                <BlueButton class="nav-btn" @click="goToNextDay">
                    <ChevronRightIco />
                </BlueButton>
            </div>
        </div>

        <table class="timeline-grid">
            <thead>
                <tr class="time-row time-header">
                    <th class="user-header-cell"></th>
                    <th
                        v-for="slot in props.records[0]?.slots || []"
                        :key="slot.date_time"
                        class="time-slot"
                    >
                        {{ dayjs(slot.date_time).format("HH:mm") }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="user in allUsers" :key="user">
                    <td class="user-cell">{{ user }}</td>
                    <td
                        v-for="slot in props.records[0]?.slots || []"
                        :key="slot.date_time + user"
                        class="time-slot"
                    >
                        <div class="events-track" @click="goto">
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
                                        width:
                                            (durationToMinutes(sub.duration) / 30) * 100 + '%',
                                    }"
                                >
                                    <div class="event-content">
                                        {{ sub.service.name }}
                                        {{ sub.subscribe.start_at.slice(11, 16) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style lang="sass" scoped>
.timeline-wrapper
    border: 1px solid #88a2ff
    border-radius: 10px
    background: #fff
    margin: 24px auto
    overflow: auto
    display: flex
    flex-direction: column

    .timeline-header
        background: rgb(216, 216, 255)
        display: flex
        justify-content: space-between
        align-items: center
        padding: 6px 12px
        gap: 8px
        position: sticky
        top: 0
        z-index: 20

        .header-title
            flex: 1
            text-align: center
            font-size: 16px
            font-weight: 500

        .date-nav-buttons
            display: flex
            gap: 6px
            white-space: nowrap

    .timeline-grid
        width: 100%
        border-collapse: separate
        border-spacing: 0
        table-layout: fixed

        th, td
            border: 1px solid #88a2ff81
            padding: 6px
            vertical-align: top
            word-break: break-word

        thead th
            background: rgb(216, 216, 255)
            position: sticky
            top: 0
            z-index: 5

        .with-controls
            background: rgb(216, 216, 255)
            display: flex
            justify-content: space-between
            align-items: center
            padding: 4px 8px

        .time-row.time-header th
            text-align: center
            font-size: 12px
            height: 40px

        .user-cell
            background: rgb(216, 216, 255)
            font-weight: 500
            font-size: 13px
            color: var(--text-color)
            width: 140px
            white-space: normal

        .time-slot
            min-width: 60px
            color: var(--text-color)
            position: relative
            text-align: center

        .events-track
            position: relative
            width: 100%
            height: 56px
            z-index: 1000

        .event-block
            position: absolute
            top: 10%
            height: 80%
            background: linear-gradient(135deg, #ab9dff, #88a2ff)
            border-radius: 4px
            padding: 4px 6px
            color: #fff
            font-size: 12px
            font-weight: 500
            white-space: nowrap
            overflow: hidden
            text-overflow: ellipsis
            z-index: 1000
</style>

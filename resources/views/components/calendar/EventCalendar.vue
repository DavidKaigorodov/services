<script setup>
import { computed } from "vue";

const props = defineProps({ records: Array });

const timeSlots = computed(() => props.records.map((slot) => slot.date_time));

const allUsers = [
    ...new Set(
        props.records.flatMap((b) => b.records.map((r) => r.user.first_name))
    ),
];

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
            <div class="user-cell"></div>
            <div v-for="time in timeSlots" :key="time" class="time-cell">
                {{ time.slice(11, 16) }}
            </div>
        </div>

        <div v-for="user in allUsers" :key="user" class="user-row">
            <div class="user-cell">{{ user }}</div>

            <div v-for="time in timeSlots" :key="time" class="time-slot">
                <div class="events-track">
                    <div
                        v-for="block in props.records.filter(
                            (b) => b.date_time === time
                        )"
                        :key="block.date_time"
                    >
                        <div
                            v-for="record in block.records.filter(
                                (r) => r.user.first_name === user
                            )"
                            :key="record.id"
                        >
                            <div
                                v-for="(sub, i) in record.subscribes"
                                :key="i"
                                class="event-block"
                                :style="{
                                    left: sub.shift + '%',
                                    width:
                                        (durationToMinutes(sub.duration) / 30) *
                                            100 +
                                        '%',
                                }"
                                :title="`${
                                    sub.service.name
                                } ${sub.subscribe.start_at.slice(11, 16)}`"
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
</template>

<style scoped>
.timeline-wrapper {
    border: 1px solid #d4d7ec;
    border-radius: 10px;
    background: #fff;
    max-width: 100%;
    margin: 24px auto;
    font-family: "Inter", sans-serif;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
.timeline-header {
    display: flex;
    background: #eef1fb;
    border-bottom: 1px solid #d4d7ec;
    position: sticky;
    top: 0;
    z-index: 10;
}
.user-cell {
    width: 160px;
    padding: 14px 12px;
    background: #f6f8ff;
    border-right: 1px solid #e0e4fa;
    flex-shrink: 0;
    position: sticky;
    left: 0;
    display: flex;
    align-items: center;
}
.time-cell {
    flex: 1;
    text-align: center;
    font-size: 13px;
    padding: 10px 6px;
    color: #4c4f66;
    border-right: 1px solid #e0e4fa;
}
.user-row {
    display: flex;
    min-height: 70px;
    border-bottom: 1px solid #f0f0f5;
}
.time-slot {
    position: relative;
    flex: 1;
    height: 70px;
    border-right: 1px solid #f0f0f5;
}
.events-track {
    position: relative;
    width: 100%;
    height: 100%;
}
.event-block {
    position: absolute;
    top: 8%;
    height: 84%;
    background: linear-gradient(135deg, #5c82ff, #6f9aff);
    border-radius: 6px;
    padding: 6px 8px;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    z-index: 2;
    white-space: normal;
}
.event-content {
    line-height: 1.4;
}
</style>

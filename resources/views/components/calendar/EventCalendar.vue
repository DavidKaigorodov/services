<script setup>
import { computed } from "vue";
dayjs
const props = defineProps({
    records: {
        type: Array,
        required: true,
    },
});

const START_TIME = 8 * 60;
const END_TIME = 18 * 60;

const timeIntervals = computed(() => {
    const intervals = [];
    for (let minutes = START_TIME; minutes <= END_TIME; minutes += 20) {
        const h = Math.floor(minutes / 60);
        const m = minutes % 60;
        intervals.push(
            `${String(h).padStart(2, "0")}:${String(m).padStart(2, "0")}`
        );
    }
    return intervals;
});

</script>

<template>
    <div class="timeline-wrapper">
        <div class="timeline-header">
            <div class="user-cell"></div>
            <div v-for="time in timeIntervals" :key="time" class="time-cell">
                {{ time }}
            </div>
        </div>

        <div v-for="user in records" :key="user.name" class="user-row">
            <div class="user-cell">
                {{ user.name }}
            </div>

            <div class="events-track">
                <div class="event-row"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.timeline-wrapper {
    border: 1px solid #97a2ff;
    border-radius: 8px;
    overflow: hidden;
    background: white;
    max-width: 100%;
    margin: 20px auto;
}

.timeline-header {
    display: flex;
    background: #97a2ff;
    border-bottom: 1px solid #97a2ff;
    position: sticky;
    top: 0;
    z-index: 10;
}

.user-cell {
    width: 140px;
    padding: 10px;
    font-weight: 600;
    text-align: center;
    background: #97a2ff;
    border-right: 1px solid #eee;
    color: #ffffff;
}

.time-cell {
    flex: 1;
    text-align: center;
    font-size: 12px;
    padding: 8px 2px;
    color: #ffffff;
    border-right: 1px solid #eee;
}

.time-cell:last-child {
    border-right: none;
}

.user-row {
    display: flex;
    min-height: 60px;
    border-bottom: 1px solid #eee;
}
.user-row:last-child {
    border-bottom: none;
}
</style>

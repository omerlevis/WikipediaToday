<script>
//get the dark mode global vy @vuex-useStore parameter and effect the layout
import { computed } from 'vue';
import { useStore } from 'vuex';
export default {
    setup() {
        const store = useStore();
        const darkMode = computed(() => store.state.darkMode);
        return { darkMode };
    },
};
</script>

<template>
    <div :class="['font-sans', 'antialiased', { 'bg-dark': darkMode }]">
        <div class="min-h-screen bg-gray-100">
            <slot></slot>
        </div>
    </div>
</template>

<style>

</style>

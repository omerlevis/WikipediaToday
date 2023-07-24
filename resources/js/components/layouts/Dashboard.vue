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
    <div :class="['card', { 'bg-light': !darkMode, 'bg-secondary': darkMode }]">
        <br />
        <div class="card-body">
            <table class="table table-bordered bg-white">
                <tbody>
            <slot></slot>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style>

</style>

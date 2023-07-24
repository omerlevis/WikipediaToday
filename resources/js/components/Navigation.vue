<script>
//define the dark mode by @vueuse/core-useDark, manage the dark mode by toggle button,
// defne the toggle button icon with material icons ans store the dark mode value globally by @vuex-seStore
import { ref, computed } from 'vue';
import { useDark } from '@vueuse/core';
import { useStore } from 'vuex';

export default {
    setup() {
        const store = useStore();
        const isDark = ref(false);
        useDark(isDark);
        const darkModeButtonIcon = computed(() => (isDark.value ? 'light_mode' : 'dark_mode'));

        const toggleDarkMode = () => {
            isDark.value = !isDark.value;
            store.commit('setDarkMode', isDark.value);
        };
        return {
            logoImg: '/images/giritLogo.png',
            darkModeButtonIcon,
            toggleDarkMode,
            isDark,
        };
    },
};
</script>

<template>
    <nav class="navbar">
        <img :src="logoImg" alt="logo" class="ms-4" />
        <button type="button" class="btn btn-light rounded-circle ms-auto" @click="toggleDarkMode">
            <i class="material-icons">{{ darkModeButtonIcon }}</i>
        </button>
    </nav>
</template>

<style>

</style>

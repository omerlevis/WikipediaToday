
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
    <tr>
        <td :class="{ 'bg-dark': darkMode }">
            <div class="row no-gutters">
                <div class="container">
            <slot></slot>
                </div>
            </div>
        </td>
    </tr>
</template>

<style>

</style>

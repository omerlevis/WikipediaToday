import { createStore } from 'vuex';

const store = createStore({
    state() {
        return {
            darkMode: false,
        };
    },
    mutations: {
        setDarkMode(state, value) {
            state.darkMode = value;
        },
    },
});

export default store;

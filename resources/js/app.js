import 'bootstrap/dist/css/bootstrap.css';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import store from './store';
import '@mdi/font/css/materialdesignicons.min.css'

import App from './components/App.vue';
import WikipediaItems from './components/WikipediaItems.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/on-this-day/:month?/:day?', component: WikipediaItems },
    ]
});

const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');

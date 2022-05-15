import { createApp, defineAsyncComponent, onMounted, computed } from 'vue';
import { useStore } from 'vuex';

import store from './store.js';

import axios from 'axios';
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

const echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: process.env.MIX_WEBSOCKET_HOST,
    wsPort: process.env.MIX_WEBSOCKET_PORT,
    disableStats: true,
    encrypted: true,
});

const app = createApp({

    components: {
    },

    setup() {

        onMounted(() => {

            axios.interceptors.request.use((config) => {
                config.headers['X-Socket-Id'] = echo.socketId();
                return config;
            });

        });

        return {

        };

    },

});

app.use(store);
app.provide('$http', axios);
app.provide('echo', echo);

import { SetupCalendar } from 'v-calendar';
app.use(SetupCalendar, {});

app.mount('#app');

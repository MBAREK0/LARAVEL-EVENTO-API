// main.js

import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import router from './router';


axios.defaults.baseURL = 'http://127.0.0.1:8000/index-category';

axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.status === 401) {
            router.push('/sign-in');
        }
        return Promise.reject(error);
    }
);

createApp(App)
    .use(router)
    .mount('#app');

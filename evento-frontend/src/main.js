import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import router from './router';


const app = createApp(App);


const refreshAccessToken = () => {
    axios.post('http://127.0.0.1:8000/auth/refresh')
        .then(response => {
            const newToken = response.data.access_token;
            localStorage.setItem('accessToken', newToken);
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + newToken;
        })
        .catch(error => {
            console.error('Token refresh failed:', error);
        });
};


setInterval(() => {
    refreshAccessToken();
}, 30 * 60 * 1000); 

app.use(router).mount('#app');

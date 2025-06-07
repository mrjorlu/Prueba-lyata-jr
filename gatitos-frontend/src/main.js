import { createApp } from 'vue'
import App from './App.vue'
import './css/main.css';
import router from './routes/router';

createApp(App).use(router).mount('#app')

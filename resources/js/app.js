import './bootstrap';

import { createApp } from 'vue';
import router from './plugins/route.js';

import app from './components/HomePage.vue';
  
createApp(app)
    .use(router)
    .mount('#app');

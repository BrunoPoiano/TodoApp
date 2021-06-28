require('./bootstrap');

import { createApp } from 'vue'
import Todoapp from './Todoapp/Todoapp.vue'

const app = createApp({});

app.component('todoapp', Todoapp).mount('#app');
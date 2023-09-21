import { createApp } from 'vue'

//tailwind
import '../../css/vue.css'

//Oruga
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'
import '@oruga-ui/oruga-next/dist/oruga-full-vars.css'

//Material Design
import "@mdi/font/css/materialdesignicons.min.css"

import App from './App.vue'
import axios from 'axios'

import router from './router'



const app = createApp(App)
            .use(router)
            .use(Oruga);

app.config.globalProperties.$axios = axios;
window.axios = axios;

app.mount('#app');
import {createRouter, createWebHistory} from "vue-router"

import List from './components/List.vue'
import Save from './components/Save.vue'

const routes = [
    {
        name:'list',
        path:'/laraprimerospasos/public/api/vue',
        component:List
    },
    {
        name:'save',
        path:'/laraprimerospasos/public/api/vue/save/:slug?',
        component:Save
    },
];

const router = createRouter({
    history:createWebHistory(),
    routes:routes
});

export default router;
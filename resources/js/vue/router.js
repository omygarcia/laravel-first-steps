import {createRouter, createWebHistory} from "vue-router"

import List from './components/List.vue'
import Save from './components/Save.vue'
import Login from './components/auth/login.vue'
import {useCookies} from 'vue3-cookies'

const {cookies} = useCookies();

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
    {
        name:'login',
        path:'/laraprimerospasos/public/api/vue/login',
        component:Login
    },
];

const router = createRouter({
    history:createWebHistory(),
    routes:routes
});

router.beforeEach((to, from, next) => {
    const auth = cookies.get('auth');

    //console.log("****"+window.laravel.isLoggedIn)

    if(!auth && to.name != 'login')
        return next({name:'login'});

    return next();
})

export default router;

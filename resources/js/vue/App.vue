<template>
    <div>
        <nav class="bg-white border-b border-gray-100">
            <header class="max-w-7xl px4 sm:px-6 lg:px-8">
                <div class="flex">
                    <div class="flex items-center">
                        <img style="width:30px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1200px-Vue.js_Logo_2.svg.png" alt="vue">
                    </div>
                    <div class="w-full flex mx-auto py-4 px-4 sm:px-6 justify-between items-center">
                        <div class="flex h-8 items-center">
                            <router-link class="inline-flex pt-1 uppercase border-b-2 tet-sm leading-5 px-4 py-1 
                            text-gray-600 text-center font-bold mx-3
                            hover:text-gray-900 hover:border-gray-700 duration-150 transition-all hover:-translate-y-1" :to="{name:'login'}">
                                Login
                            </router-link>
                            <o-button variant="danger" @click="logout">
                                Logout
                            </o-button>
                        </div>


                        <div class="rounded-full w-9 h-9 bg-blue-300 text-center p-1 font-bold">
                            AN
                        </div>
                        <p v-if="$root.isLoggedIn">
                            {{$root.user.name}}
                        </p>
                    </div>
                </div>
            </header>
        </nav>
        <!--<h1>Principal</h1>-->
        <!--<List />-->
        
        <router-view></router-view>
    </div>
</template>

<script>

export default {
    data(){
        return{
            isLoggedIn:false,
            user:'',
            token:'',
        }
    },
    created(){
        console.log(window.laravel);
        if(window.laravel != undefined && window.laravel.isLoggedIn)
        {
            this.isLoggedIn = true;
            this.user = window.laravel.user;
            this.token = window.laravel.token;
        }else{
            const auth = this.$cookies.get('auth');
            if(auth)
            {
                this.$axios.post("/laraprimerospasos/public/api/user/token-check",{
                    'token':auth.token
                })
                .then((res)=>{
                    console.log(res)
                })
                .catch(()=>{
                    this.setCookieAuth("");
                    window.location.href = "/laraprimerospasos/public/api/vue/login";
                });
            }
        }
    },
    methods:{
        logout(){
            const auth = this.$cookies.get('auth');
            this.$axios.post('/laraprimerospasos/public/api/user/logout',{
                'token':auth.token
            })
            .then((res)=>{
                this.setCookieAuth('');
                window.location.href='/laraprimerospasos/public/api/vue/login';
            });
        },
        setCookieAuth(data){
            this.$cookies.set("auth",data);
        }
    }
}
</script>

<style>

</style>
<template>
    <div>
        <header>
            <div class="flex gap-3 bg-gray-200">
                <router-link :to="{name:'login'}">Login</router-link>
                <o-button variant="danger" @click="logout">
                    Logout
                </o-button>
            </div>
        </header>
        {{$root}}
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
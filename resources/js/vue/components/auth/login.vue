<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-md">
            <h2 class="mt-6 mb-6 text-center text-3xl tracking-tight font-bold text-gray-900">
                Sign in to your account
            </h2>
            <form @submit.prevent="submit">
                <o-field label="Username" :variant="errors.login?'danger':''"
                    message=""
                >
                    <o-input v-model="form.email"></o-input>
                </o-field>
                <o-field label="Password" :variant="errors.login?'danger':''"
                    :message="errors.login"
                >
                    <o-input v-model="form.password" type="password"></o-input>
                </o-field>
                <o-button :disabled="disabledButton" class="float-right" variant="primary" native-type="submit">
                    Ingresar
                </o-button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    created(){
        if(this.$root.isLoggedIn){
            this.$router.push({name:'list'});
        }
    },
    data(){
        return{
            form:{
                email:'',
                password:''
            },
            errors:{
                login:""
            },
            disabledButton:false
        }
    },
    methods:{
        clearForm()
        {
            this.form.email = '';
            this.form.password = '';
            this.errors.login = '';
        },
        submit(){
            this.disabledButton = true;
            this.$axios.post('/laraprimerospasos/public/api/user/login',this.form)
            .then((res)=>{
                console.log(res);
                this.$root.setCookieAuth(res.data);
                this.clearForm();
                setTimeout(()=>{
                    this.disabledButton = false;
                    window.location.href = "/laraprimerospasos/public/api/vue"
                },1500);

                this.$oruga.notification.open({
                    message:'Login success',
                    position:'bottom-right',
                    duration:1000,
                    closable:true
                });
            })
            .catch(error=>{
                console.log(error);
                 this.disabledButton = false;
                if(error.response.data)
                {
                    this.errors.login = error.response.data;
                }
            });

        }
    }
}
</script>

<style>

</style>
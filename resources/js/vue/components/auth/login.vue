<template>
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
        <o-button variant="primary" native-type="submit">
            Ingresar
        </o-button>
    </form>
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
            }
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
            this.$axios.post('/laraprimerospasos/public/api/user/login',this.form)
            .then((res)=>{
                console.log(res);
                this.$root.setCookieAuth(res.data);
                this.clearForm();
                setTimeout(()=>{
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
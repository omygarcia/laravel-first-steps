<template>
    <div class="container mx-auto">
        <div class="mt-6 py-4 bg-white shadow-md rounded-md mb-2">
            <h1 v-if="post">Actualizar Post <span class="font-bold">{{post.title}}</span></h1>
            <h1 v-else>Crear Post</h1>
            <form @submit.prevent="submit">
                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-2">
                        <o-field label="Titulo" :variant="errors.title?'danger':''" :message="errors.title?errors.title:''">
                            <o-input v-model="form.title" value=""></o-input>
                        </o-field>
                    </div>
                    <o-field label="Descripción" :variant="errors.description?'danger':''" :message="errors.description?errors.description:''">
                        <o-input v-model="form.description" type="textarea" value=""></o-input>
                    </o-field>
                    <o-field label="Contenido" :variant="errors.content?'danger':''" :message="errors.content?errors.content:''">
                        <o-input v-model="form.content" type="textarea" value=""></o-input>
                    </o-field>
                    <o-field label="Categoria" :variant="errors.category_id?'danger':''" :message="errors.category_id?errors.category_id:''">
                        <o-select v-model="form.category_id" placeholder="Seleccione una categoria">
                            <option v-for="c in categories" :key="c.id" :value="c.id">{{c.title}}</option>
                        </o-select>
                    </o-field>
                    <o-field label="Posted" :variant="errors.posted?'danger':''" :message="errors.posted?errors.posted:''">
                        <o-select v-model="form.posted" placeholder="Seleccione un estado">
                            <option value="yes">Si</option>
                            <option value="not">No</option>
                        </o-select>
                    </o-field>

                    <o-field v-if="post" class="file">
                        <o-upload v-model="file">
                            <o-button tag="a" variant="primary">
                                <o-icon icon="upload"></o-icon>
                                <span>Click para cargar</span>
                            </o-button>
                        </o-upload>
                        <span class="file-name" v-if="file">
                            {{ file.name }}
                        </span>
                        <o-button @click="upload" icon-left="upload">
                            Subir
                        </o-button>
                    </o-field>
                </div>
                <o-field horizontal><!-- Label left empty for spacing -->
                    <o-button native-type="submit" variant="primary">Guardar</o-button>
                </o-field>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            categories:[],
            form:{
                title:"",
                description:"",
                content:"",
                category_id:"",
                posted:""
            },
            errors:{
                title:"",
                description:"",
                content:"",
                category_id:"",
                posted:""
            },
            post:"",
            file:null
        }
    },
    async mounted(){
        if(this.$route.params.slug)
        {
            await this.getPost();
            this.initPost();
        }
        this.getCategory();
    },
    methods:{
        cleanErrorsForm(){
            this.errors.title           = "";
            this.errors.description     = "";
            this.errors.content         = "";
            this.errors.category_id     = "";
            this.errors.posted          = "";
        },
        submit(){
            console.log(this.form);
            this.cleanErrorsForm();

            if(this.post == "")
            {
                this.$axios.post('/laraprimerospasos/public/api/post',this.form)
                .then((res)=>{
                    console.log(res);
                    this.$oruga.notification.open({
                        message:'El posts se registro con exito!',
                        position:'bottom-right',
                        duration:4000,
                        closable:true
                    });
                })
                .catch(err=>{
                    console.log(err.response.data);

                    if(err.response.data.title)
                        this.errors.title = err.response.data.title[0];
                    if(err.response.data.description)
                        this.errors.description = err.response.data.description[0];
                    if(err.response.data.content)
                        this.errors.content = err.response.data.content[0];
                    if(err.response.data.category_id)
                        this.errors.category_id = err.response.data.category_id[0];
                    if(err.response.data.posted)
                        this.errors.posted = err.response.data.posted[0];
                });
            }else{
                //actualizar
                this.$axios.put('/laraprimerospasos/public/api/post/'+this.post.id,this.form)
                .then((res)=>{
                    console.log(res);
                     this.$oruga.notification.open({
                        message:'El posts se actualizo con exito!',
                        position:'bottom-right',
                        duration:4000,
                        closable:true
                    });
                })
                .catch(err=>{
                    console.log(err.response.data);

                    if(err.response.data.title)
                        this.errors.title = err.response.data.title[0];
                    if(err.response.data.description)
                        this.errors.description = err.response.data.description[0];
                    if(err.response.data.content)
                        this.errors.content = err.response.data.content[0];
                    if(err.response.data.category_id)
                        this.errors.category_id = err.response.data.category_id[0];
                    if(err.response.data.posted)
                        this.errors.posted = err.response.data.posted[0];
                });
            }
        },
        upload(){
            //return console.log(this.file);
            const formData = new FormData();
            formData.append("image",this.file);


            this.$axios.post("/laraprimerospasos/public/api/post/upload/"+this.post.id,formData,{
                headers:{
                    "Content-Type":"multipart/form-data"
                }
            })
            .then(rep=>{
                this.$oruga.notification.open({
                    message:"La imagen se cargo con exito!",
                    position:'bottom-right',
                    duration:4000,
                    closable:true
                });
            })
            .catch(err=>{
                console.log(err)
                const msg = err.response.data.errors.image[0];
                this.$oruga.notification.open({
                    message:msg,
                    variant:'danger',
                    position:'bottom-right',
                    duration:4000,
                    closable:true
                });
            });
        },
        getCategory(){
            this.$axios.get('/laraprimerospasos/public/api/category/all').then(res=>{
                //console.log(res.data);
                this.categories = res.data;
            });
        },
        async getPost(){
            const data =  await this.$axios.get('/laraprimerospasos/public/api/post/slug/'+this.$route.params.slug);

            this.post = data.data;
            console.log(this.post);
        },
        initPost(){
            this.form.title         = this.post.title;
            this.form.description   = this.post.description;
            this.form.content       = this.post.content;
            this.form.category_id   = this.post.category_id;
            this.form.posted        = this.post.posted;
        }
    }
}
</script>

<style>

</style>
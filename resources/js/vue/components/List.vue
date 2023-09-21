<template>
    <div>
        <o-modal v-model:active="confirmDeleteActive">
            <div class="p-4">
                <p>¿Seguro que quieres eliminar el registro <b>{{deletePostRow?.row?.title}}</b>?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
                <o-button @click="deletePostRow='';confirmDeleteActive=false" variant="danger">Cancelar</o-button>
                <o-button @click="deletePost(deletePostRow)">Aceptar</o-button>
            </div>
        </o-modal>
        <h1>Listado de Post</h1>
        <o-button iconLeft="plus" size="small" @click="$router.push({ name: 'save'})">
            Crear Post
        </o-button>
        <div class="my-4"></div>
        <o-table :loading="isLoading" :data="posts.length == 0?[]:posts" :mobile-cards="false">
            <o-table-column field="id" label="Id" numeric v-slot="p">
                {{p.row.id}}
            </o-table-column>
            <o-table-column field="posted" label="Posteado" numeric v-slot="p">
                {{p.row.posted}}
            </o-table-column>
            <o-table-column field="created_at" label="Fecha" numeric v-slot="p">
                {{p.row.created_at}}
            </o-table-column>
            <o-table-column field="category" label="Categoria" numeric v-slot="p">
                {{p.row.category.title}}
            </o-table-column>
            <o-table-column field="slug" label="Acciones" numeric v-slot="p">
                <router-link class="mr-3" :to="{ name: 'save', params:{'slug':p.row.slug}}">
                    Editar
                </router-link>
                <o-button @click="deletePostRow=p;confirmDeleteActive=true" iconLeft="delete" rounded size="small" variant="danger" >
                    Eliminar
                </o-button>
            </o-table-column>
        </o-table>
        <hr />
         <o-pagination
            v-if="posts.length > 0"
            @change="listPage"
            :total="total"
            v-model:current="current"
            :range-before="rangeBefore"
            :range-after="rangeAfter"
            :order="order"
            :size="size"
            :simple="isSimple"
            :rounded="isRounded"
            :per-page="perPage"
            :icon-prev="prevIcon"
            :icon-next="nextIcon"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"
        >
        </o-pagination>
    </div>
</template>

<script>
export default {
    data(){
        return{
            posts:[],
            isLoading:true,
            //paginacion
            rangeBefore:3,
            rangeAfter:1,
            isSimple:false,
            isRounded:true,
            prevIcon:'chevron-left',
            nextIcon:'chevron-right',
            total:200,
            current:10,
            perPage:10,
            order:'centered',
            size:'small',

            confirmDeleteActive:false,
            deletePostRow:""
        }
    },
    methods:{
        listPage(p = 1){
            console.log("Click",p);
            //console.log("Click curr",this.current);
            this.$axios.get('/laraprimerospasos/public/api/post',{params:{page:p}})
            .then(res=>{
                const data = res.data;
                this.posts = data.data
                console.log(this.posts,res.data)
                this.isLoading = false;

                this.current = data.current_page;
                this.perPage = data.per_page;
                this.total = data.total;
            });
        },
        deletePost({index,row}){
            //console.log(p)
            this.$axios.delete('/laraprimerospasos/public/api/post/'+row.id)
            .then(res=>{
                console.log(res);
                this.posts.splice(index,1);
                this.confirmDeleteActive=false;
                this.$oruga.notification.open({
                    message:'Registro eliminado',
                    position:'bottom-right',
                    variant:'danger',
                    duration:4000,
                    closable:true
                });
            });
        }
    },
    async mounted(){
        this.listPage();
    }
}
</script>

<style>

</style>
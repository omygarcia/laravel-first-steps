<template>
    <div>
        <!--<h1>Principal</h1>-->
        <!--<List />-->
        <router-view></router-view>
    </div>
</template>

<script>
import List from './components/List.vue';
import Save from './components/Save.vue';

export default {
    components:{
        List,
        Save
    }
}
</script>

<style>

</style>
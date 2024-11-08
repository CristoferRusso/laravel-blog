<template>
    <div>
        <TopBar/>
        <!-- Vista componenti Vue -->
        <router-view></router-view>
    </div>
</template>

<script>
import TopBar from './layout/TopBar.vue';


export default {
    components: {
        TopBar,
    }
};
</script>

<style>
</style>

<template>
        <router-view></router-view>
</template>
<script>


    export default {
        mounted() {
            window.axios.defaults.headers.common['Authorization'] = 'Bearer '+this.$store.state.token;
        }
    }
</script>

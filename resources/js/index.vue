<template>

        <router-view></router-view>
</template>
<script>


    export default {
        components:{
            // Loading
        },
        data(){
          return{
              isLoading:false,
              fullPage :true,
          }
        },
        methods:{
            checkLoginAuth(){
                axios.get('/api/user')
                    .then((res) =>{
                        // console.log(res)
                        this.$store.commit("get_current_user",res.data);
                    }).catch((err)=>{
                    // console.log(err)
                })
            }
        },
        mounted() {
            window.axios.defaults.headers.common['Authorization'] = 'Bearer '+this.$store.state.token;
            this.checkLoginAuth();
        },
    }
</script>

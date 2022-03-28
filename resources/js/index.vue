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
                if(this.$store.state.token !== ""){
                    axios.get('/api/user')
                        .then((res) =>{
                            // console.log(res)
                            this.$store.commit("get_current_user",res.data);
                        }).catch((err)=>{
                        // console.log(err)
                        this.$store.commit("get_current_user",{});
                        this.$store.commit("get_token","");
                    })
                }

            },
        },
        mounted() {
            window.axios.defaults.headers.common['Authorization'] = 'Bearer '+this.$store.state.token;
            this.checkLoginAuth();
        },
        watch:{
            $route(to, from) {
                window.scrollTo(0, 0);
                document.querySelector(".fas.fa-times")?.click();
            }
        }
    }
</script>

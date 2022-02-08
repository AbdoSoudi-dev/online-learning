<template>
    <div class="main-wrapper">

        <header-component></header-component>

        <sidebar></sidebar>

        <router-view></router-view>

    </div>
</template>

<script>
    import header from "../components/header";
    import sidebar from "../components/sidebar";
    export default {
        components: {
            "header-component": header,
            sidebar
        },
        methods:{
            checkLoginAuth(){
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
        beforeMount() {
            window.axios.defaults.headers.common['Authorization'] = 'Bearer '+this.$store.state.token;
            this.checkLoginAuth();

        }

    }
</script>

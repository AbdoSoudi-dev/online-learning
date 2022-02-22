<template>
     <div class="header">

            <div class="header-left">
                <a class="logo">
                    <a href="/">
                        <img :src="'/adminAssets/img/logo.png'" alt="Logo">
                    </a>
                </a>
                <a class="logo logo-small">
                    <a href="/">
                        <img :src="'/adminAssets/img/logo-small.png'" alt="Logo" width="30" height="30">
                    </a>

                </a>
            </div>

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>

            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>


            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" :src="'/adminAssets/img/profiles/avatar-12.jpg'" width="31" alt="Ryan Taylor"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img :src="'/adminAssets/img/profiles/avatar-12.jpg'" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>Allen Davis</h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" >My Profile</a>
                        <a class="dropdown-item" >Settings</a>
                        <a class="dropdown-item" style="cursor: pointer" @click="logout()">Logout</a>
                    </div>
                </li>

            </ul>

        </div>
</template>

<script>
    export default {
        methods:{
            logout(){
                axios.delete('/api/logout')
                    .then((res) =>{
                        // console.log(res)
                        this.$store.commit("get_current_user",{});
                        this.$store.commit("get_current_user","");
                        location.href = "/";
                    }).catch((err)=>{
                    // console.log(err)
                })
            }
        }
    }
</script>

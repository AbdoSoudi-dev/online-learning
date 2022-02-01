<template>
        <header class="header">
            <div class="header-fixed">
                <nav class="navbar navbar-expand-lg header-nav">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                            </span>
                        </a>
                        <a class="navbar-brand logo">
                            <router-link to="/">
                                <img src="/assets/img/logo.png" class="img-fluid" alt="Logo">
                            </router-link>
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a class="menu-logo">
                                <router-link to="/">
                                    <img src="/assets/img/logo.png" class="img-fluid" alt="Logo">
                                </router-link>
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <ul class="main-nav">
                            <li class="">
                                <router-link to="/">Home</router-link>
                            </li>
                            <li class="has-submenu">
                                <router-link to="/coursesList">Courses <i class="fas fa-chevron-down"></i></router-link>
                                <ul class="submenu">
                                    <li v-for="course in coursesList">
                                        <router-link :to="'/course/'+course.id">{{ course.title }}</router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <router-link to="/">About Us</router-link>
                            </li>
                            <li v-if="$store.state.currentUser.role_id && $store.state.currentUser.role_id != 1">
                                <router-link to="/admin">Admin</router-link>
                            </li>
                            <li class="login-link">
                                <router-link to="/login">Login / Signup</router-link>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item" v-if="!$store.state.currentUser.role_id">
<!--                            <a class="nav-link" href="login.vue.html">Login</a>-->
                            <router-link class="nav-link" to="/login">Login</router-link>
                        </li>
                        <li class="nav-item" v-if="!$store.state.currentUser.role_id">
<!--                            <a class="nav-link header-login.vue" href="register.html">Register</a>-->
                            <router-link class="nav-link  header-login" to="/register">register</router-link>
                        </li>
                        <li class="nav-item dropdown has-arrow logged-item" v-else>
                            <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                <span class="user-img">
                                <img class="rounded-circle" src="/assets/img/user/user.jpg" width="31" alt="Darren Elder">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="/assets/img/user/user.jpg" alt="User Image" class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
                                        <h6>Jonathan Doe</h6>
                                        <p class="text-muted mb-0">Mentor</p>
                                    </div>
                                </div>
                                <a class="dropdown-item">
                                    <router-link to="/profile">Profile Settings</router-link>
                                </a>
                                <a class="dropdown-item" style="cursor: pointer" @click="logout()">Logout</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
</template>

<script>

    export default {
        data(){
            return{
                coursesList:[],
            }
        },
        methods:{
            logout(){
                axios.delete('/api/logout')
                    .then((res) =>{
                        // console.log(res)
                        this.$store.commit("get_current_user",{});
                        this.$store.commit("get_current_user","");
                        this.$router.push("/");
                    }).catch((err)=>{
                    // console.log(err)
                })
            },
            getCourses(){
                axios.get("/api/courses")
                    .then((res)=>{
                        this.coursesList = res.data;
                    })
                    .catch((err)=>{
                        // console.log(err);
                    });
            }
        },
        beforeMount() {
            this.getCourses();
            let style = document.createElement('link');
            style.type = "text/css";
            style.rel = "stylesheet";
            style.href = '/assets/css/style.css';
            style.id = "userStyle";

            document.head.appendChild(style);
        },
        unmounted() {
            document.getElementById("userStyle").remove();
        }
    }
</script>


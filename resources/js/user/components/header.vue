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
                                <router-link to="/">
                                    Home
                                </router-link>
                            </li>
                            <li class="has-submenu">
                                <router-link to="/courses_list">Courses <i class="fas fa-chevron-down"></i></router-link>
                                <ul class="submenu">
                                    <li v-for="course in $store.state.courses">
                                        <router-link :to="'/course/'+course.id">{{ course.title }}</router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <router-link to="/pricing">Pricing</router-link>
                            </li>
                            <li v-if="$store.state.currentUser.role_id && $store.state.currentUser.role_id != 1">
                                <a href="/admin">Admin</a>
                            </li>

                            <li class="nav-item d-block d-md-none" v-if="!$store.state.currentUser.role_id">
                                <router-link class="nav-link" to="/login">Login</router-link>
                            </li>
                            <li class="nav-item d-block d-md-none" v-if="!$store.state.currentUser.role_id">
                                <router-link class="nav-link  header-login" to="/register">register</router-link>
                            </li>
                            <li class="nav-item d-block d-md-none" v-if="$store.state.currentUser.role_id">
                                <router-link to="/profile">
                                    Profile Settings
                                </router-link>
                            </li>
                            <li class="nav-item d-block d-md-none" v-if="$store.state.currentUser.role_id">
                                <a class="dropdown-item cursor-pointer" @click="logout()">Logout</a>
                            </li>
                            <li class="" v-if="$store.state.currentUser.role_id">
                                <router-link to="/schedule_timings">Meetings</router-link>
                            </li>
                            <li class="">
                                <router-link to="/aboutus">About Us</router-link>
                            </li>


                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item" v-if="!$store.state.currentUser.role_id">
                            <router-link class="nav-link" to="/login">Login</router-link>
                        </li>
                        <li class="nav-item" v-if="!$store.state.currentUser.role_id">
                            <router-link class="nav-link  header-login" to="/register">register</router-link>
                        </li>
                        <li class="nav-item dropdown has-arrow logged-item" v-else>
                            <a class="dropdown-toggle nav-link cursor-pointer head-photo" data-bs-toggle="dropdown">
                                <span class="user-img">
                                    <img class="rounded-circle" :src="'/profile_images/' + $store.state.currentUser.profile_image" v-if="$store.state.currentUser.profile_image" width="31" :alt="$store.state.currentUser.name">
                                    <img v-else src="/profile_images/avatar.png" width="31" class="rounded-circle" alt="avatar">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img :src="'/profile_images/' + $store.state.currentUser.profile_image" v-if="$store.state.currentUser.profile_image" :alt="$store.state.currentUser.name" class="avatar-img rounded-circle">
                                        <img v-else class="avatar-img rounded-circle" src="/profile_images/avatar.png" alt="avatar">
                                    </div>
                                    <div class="user-text text-capitalize">
                                        <h6>{{ $store.state.currentUser.name }}</h6>
                                        <p class="text-muted mb-0">{{ $store.state.currentUser.role_id == 1 ? "Trainee" : "Trainer" }}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item">
                                    <router-link to="/profile">Profile Settings</router-link>
                                </a>
                                <a class="dropdown-item cursor-pointer" @click="logout()">Logout</a>
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

            }
        },
        methods:{
            async logout(){
                const logoutAuth = await axios.delete('/api/logout');

                    if (+logoutAuth.status == 200) {
                        this.$store.commit("get_current_user", {});
                        this.$store.commit("get_token", "");
                        this.$router.push("/");
                    }else{
                        alert("Something went wrong");
                    }

            },
            async checkLoginAuth(){
                if (this.$store.state.token !== "") {
                    const loginAuth = await axios.get('/api/user');
                    if (+loginAuth.status == 200) {
                        this.$store.commit("get_current_user", loginAuth.data);
                    } else {
                        this.$store.commit("get_current_user", {});
                        this.$store.commit("get_token", "");
                    }
                }
            },
            async getCourses(){
                const courses = await axios.get("/api/courses");
                this.$store.commit("get_courses",courses.data);
            }
        },
        beforeMount() {
            window.axios.defaults.headers.common['Authorization'] = 'Bearer '+this.$store.state.token;
            this.getCourses();
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

<style scoped>
    .head-photo:hover{
        background-color: #0d6efd;
    }
</style>

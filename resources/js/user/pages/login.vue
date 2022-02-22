<template>
    <div class="main-wrapper">

        <div class="bg-pattern-style">
            <div class="content">

                <div class="account-content">
                    <div class="account-box">
                        <div class="login-right">
                            <div class="login-header">
                                <h3>Login <span>Quraan education</span></h3>
                                <p class="text-muted">Access to our services</p>
                                <h4 class="m-auto text-center text-danger" v-if="errors.message">
                                    Email or password is wrong
                                </h4>
                            </div>
                            <form @submit.prevent="loginForm">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input type="email" class="form-control" v-model="formData.email" required>
                                    <label class="col-12 text-danger" v-if="errors.email">{{ errors.email[0] }}</label>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" v-model="formData.password" required>
                                        <span class="fas fa-eye toggle-password"></span>
                                        <label class="col-12 text-danger" v-if="errors.password">{{ errors.password[0] }}</label>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a class="forgot-link">
                                        <router-link to="/resetPassword">
                                            Forgot Password ?
                                        </router-link>
                                    </a>
                                </div>
                                <button class="btn btn-primary login-btn" type="submit">Login</button>
                                <div class="text-center dont-have">Don’t have an account? <router-link to="/register">Register</router-link> </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>


<script>
    export default {
        data(){
            return{
                formData:{
                    email:"",
                    password:"",
                },
                errors:{}
            }
        },
        methods:{
            loginForm(){
                axios.post('/api/login',this.formData)
                    .then((res) =>{
                        // console.log(res)
                        this.$store.commit("get_token",res.data.token);
                        this.$store.commit("get_current_user",res.data.user);
                        if (res.data.user.role_id == 1){
                            this.$router.push("/");
                        }else{
                            this.$router.push("/");
                        }

                }).catch((err)=>{
                    // console.log(err)
                    this.errors = err.response.data;
                })
            }
        }
    }
</script>

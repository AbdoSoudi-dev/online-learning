<template>
    <div class="main-wrapper">

        <div class="bg-pattern-style bg-pattern-style-register">
            <div class="content">

                <div class="account-content">
                    <div class="account-box">
                        <div class="login-right">
                            <div class="login-header">
                                <h3><span>Mentoring</span> Register</h3>
                                <p class="text-muted">Access to our dashboard</p>
                            </div>

                            <form @submit.prevent="registerForm">
                                <div class="row">
                                        <div class="form-group">
                                            <label class="form-control-label">Name</label>
                                            <input id="first-name" type="text" class="form-control" name="name" v-model="formData.name" required>
                                            <label class="col-12 text-danger" v-if="errors.name">{{ errors.name[0] }}</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input id="email" type="email" class="form-control" v-model="formData.email" required>
                                    <label class="col-12 text-danger" v-if="errors.email">{{ errors.email[0] }}</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" v-model="formData.password" required>
                                            <label class="col-12 text-danger" v-if="errors.password">{{ errors.password[0] }}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="formData.password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-check-xs custom-checkbox">
                                        <input type="checkbox" class="form-check-input" name="agreeCheckboxUser" id="agree_checkbox_user">
                                        <label class="form-check-label" for="agree_checkbox_user">I agree to Mentoring</label> <a tabindex="-1" href="javascript:void(0);">Privacy Policy</a> &amp; <a tabindex="-1" href="javascript:void(0);"> Terms.</a>
                                    </div>
                                </div>
                                <button class="btn btn-primary login-btn" type="submit">Create Account</button>
                                <div class="account-footer text-center mt-3">
                                    Already have an account? <a class="forgot-link mb-0" ><router-link to="/login">Login</router-link></a>
                                </div>
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
                    name:"",
                    email:"",
                    password:"",
                    password_confirmation:"",
                },
                errors:{}
            }
        },
        methods:{
            registerForm(){
                axios.post('/api/register',this.formData).then((res) =>{
                    // console.log(res)
                    if (res.data.user.role_id == 1){
                        this.$router.push("/");
                    }else{
                        this.$router.push("/admin");
                    }
                    this.$store.commit("get_token",res.data.token);
                    this.$store.commit("get_current_user",res.data.user);
                }).catch((err)=>{
                    // console.log(err)
                    this.errors = err.response.data.errors;
                })
            }
        }
    }
</script>

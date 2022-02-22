<template>
    <div class="main-wrapper">

        <div class="bg-pattern-style">
            <div class="content">

                <div class="account-content">
                    <div class="account-box">
                        <div class="login-right">
                            <div class="login-header">
                                <h3>Reset Password <span></span></h3>
                                <p class="text-muted">Access to our dashboard</p>
                                <h4 class="m-auto text-center text-danger" v-if="errors.message">
                                    {{ errors.message }}
                                </h4>
                            </div>
                            <form @submit.prevent="resetForm">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input type="email" class="form-control" v-model="formData.email" required>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" v-model="formData.password" required>
                                            <label class="col-12 text-danger" v-if="errors.password">{{ errors.password[0] }}</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="formData.password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary login-btn" type="submit" :disabled="waiting">{{ waiting ? "waiting.." : "Reset"}}</button>
                                <div class="account-footer text-center mt-3">
                                    Remember your account? <a class="forgot-link mb-0" ><router-link to="/login">Login</router-link></a>
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
                    email:"",
                    token:this.$route.query.token,
                    password:"",
                    password_confirmation:""
                },
                errors:{},
                response:"",
                waiting:false
            }
        },
        methods:{
            resetForm(){
                this.waiting = true;
                this.response = "";
                this.errors = {};
                axios.post('/api/reset-password',this.formData)
                    .then((res) =>{
                        // console.log(res);
                        this.$router.push("/login");
                    this.response = res.data.status;
                    this.waiting = false;

                }).catch((err)=>{
                    // console.log(err)
                    this.waiting = false;

                    this.errors = err.response.data;
                })
            },

        },
    }
</script>

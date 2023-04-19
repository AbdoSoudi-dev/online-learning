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
                                <h4 class="m-auto text-center text-danger" v-if="errors">
                                    Email is wrong
                                </h4>
                                <h4 class="m-auto text-center text-primary" v-if="response">
                                    {{ response }}
                                </h4>
                            </div>
                            <form @submit.prevent="resetForm">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input type="email" class="form-control" v-model="formData.email" required>
                                </div>
                                <button v-if="!response" class="btn btn-primary login-btn" type="submit" :disabled="waiting">{{ waiting ? "waiting.." : "Reset"}}</button>
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
                },
                errors:false,
                response:"",
                waiting:false
            }
        },
        methods:{
           async resetForm(){
                this.waiting = true;
                this.response = "";
                this.errors = false;

                await axios.post('/api/forgot_password',this.formData)
                        .then((res) =>{
                            this.response = res.data.status;
                            this.waiting = false;
                        })
                        .catch((err)=>{
                            this.waiting = false;
                            this.errors = true;
                        })
            }
        }
    }
</script>

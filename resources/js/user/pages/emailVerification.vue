<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <h3>Verify Your Email</h3>
        <div class="card">
            <div class="card-body">

                <form @submit.prevent="sendVerification">
                    <div class="row form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="email" readonly >
                            </div>
                        </div>
                    </div>
                    <h4 class="text-warning text-center m-auto text-bold" v-if="wait">
                        Waiting...
                    </h4>
                    <div class="submit-section" v-else-if="!sentVerification">
                        <button type="submit" class="btn btn-success submit-btn">Verify</button>
                    </div>
                    <div v-else-if="error">
                        <h4 class="text-danger text-bold">
                            Something went wrong.. Try again later.
                        </h4>
                    </div>
                    <div v-else>
                        <h4 class="text-primary text-bold">
                            Email Verification Sent to {{ email }}
                            <br>
                           <small> Check your inbox! </small>
                        </h4>
                    </div>
                </form>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "emailVerification",
        data(){
            return{
                email:this.$store.state.currentUser.email,
                sentVerification: false,
                wait:false,
                error:false
            }
        },
        methods:{
            async sendVerification(){
                this.wait = true;
                this.sentVerification = true;
                await axios.post("/api/email/verify/resend").then(res =>{
                    this.wait = false;
                }).catch(err =>{
                    this.wait = false;
                    this.error = true;
                });
            }
        },
        beforeMount() {
            if(this.$store.state.currentUser.email_verified_at){
                this.$router.push("/profile");
            }
        }

    }
</script>

<style scoped>

</style>

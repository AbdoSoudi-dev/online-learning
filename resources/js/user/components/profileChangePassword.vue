<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <h3>Change Your Password</h3>
        <div class="card">
            <div class="card-body">

                <form @submit.prevent="changePassword" id="changePassword">
                    <div class="row form-row">
                        <div class="col-12" v-if="response">
                            <h5 class="text-bold text-center m-auto text-warning">{{ response.errors?.password ? response.errors?.password[0] : response }}</h5>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control" v-model="old_password" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" v-model="password" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" v-model="password_confirmation" required>
                            </div>
                        </div>

                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "profileChangePassword",
        data(){
          return{
              old_password:"",
              password:"",
              password_confirmation:"",
              response:""
          }
        },
        methods:{
            changePassword(){
                axios.put("/api/changePassword",{
                       old_password: this.old_password,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                     })
                     .then( (res)=>{
                         this.response = res.data;
                         this.old_password = "";
                         this.password = "";
                         this.password_confirmation = "";
                     })
                     .catch( (error)=>{
                         this.response = error.response.data;
                     })
            }
        },
        watch:{
            response(){
                setTimeout(()=>{
                    this.response = "";
                },10000)
            }
        },
        beforeMount() {

        }
    }
</script>

<style scoped>

</style>

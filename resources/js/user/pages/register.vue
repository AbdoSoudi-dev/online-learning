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
                                <div class="form-group">
                                    <label class="form-control-label">Mobile Number</label>
                                        <vue-tel-input styleClasses="form-control"
                                            :value="formData.mobile_number" invalidMsg="invalid Number"
                                                       @input="countryChanged"
                                                       enabledCountryCode="true"></vue-tel-input>
<!--                                    <label class="col-12 text-danger" v-if="errors.mobile_number">{{ errors.mobile_number[0] }}</label>-->
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Country</label>

                                            <form>
                                                <input type="search" class="form-control"
                                                       placeholder="Search Country" v-model="formData.country"
                                                       list="data_countries" />

                                                <datalist id="data_countries">
                                                    <option v-for="(country,key) in contries" :value="key" />
                                                </datalist>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">City</label>
                                            <select id="city" type="text" class="form-control" name="city" v-model="formData.city" required>
                                                <option value="">~~ City ~~</option>
                                                <option v-for="city in cities" :value="city">
                                                    {{ city }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
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

    import countriesCities from "../../countriesCities";
    export default {
        data(){
            return{
                formData:{
                    name:"",
                    email:"",
                    mobile_number:null,
                    password:"",
                    country:"",
                    city:"",
                    password_confirmation:"",
                },
                errors:{},
                country:"",
                contries:{},
                cities:[]
            }
        },
        methods:{
            registerForm(){
                // axios.post('/api/register',this.formData).then((res) =>{
                //     // console.log(res)
                //     if (res.data.user.role_id == 1){
                //         this.$router.push("/");
                //     }else{
                //         this.$router.push("/admin");
                //     }
                //     this.$store.commit("get_token",res.data.token);
                //     this.$store.commit("get_current_user",res.data.user);
                // }).catch((err)=>{
                //     // console.log(err)
                //     this.errors = err.response.data.errors;
                // })
                console.log(this.formData);
            },
            countryChanged(phone, phoneObject, input){
                console.log(phoneObject);
                if (phoneObject?.formatted) {
                    this.formData.mobile_number = phoneObject.number
                }
                if(phoneObject.country.name){
                    this.formData.country = phoneObject.country.name.split("(") ?
                        phoneObject.country.name.split("(")[0].trim() : phoneObject.country.name.trim();
                    this.country =this.formData.country;
                }

            }
        },
        watch:{
            formData: {
              handler:function (newValue) {
                  this.country = newValue.country;
              },
              deep:true
            },
            country(){
                this.cities =( countriesCities[this.formData.country] ?
                    countriesCities[this.formData.country].filter(function(item, pos, self) {
                    return self.indexOf(item) == pos;
                     })
                    : countriesCities[this.formData.country]);
            },
            cities(){
                this.formData.city = "";
            }
        },
        mounted(){
            this.contries = countriesCities;
            var tz = jstz.determine();
            var timezone = tz.name();
            console.log(timezone);
        }
    }
</script>


<template>
    <div class="main-wrapper">

        <div class="bg-pattern-style bg-pattern-style-register">
            <div class="content">

                <div class="account-content">
                    <div class="account-box">
                        <div class="login-right">
                            <div class="login-header">
                                <h3><span>Quraan education</span> Register</h3>
                                <p class="text-muted">Access to our services</p>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="dropdown d-flex ">
                                                <span class="btn btn-outline-primary dropdown-toggle d-flex w-20 pt-2 border" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <div :class="'mt-1 ml-2 vti__flag '+ ( (currentCountry.iso2 ?? allCountries[0].iso2).toLowerCase() )"></div>
                                                </span>

                                                <input type="tel" placeholder="write your number" v-model="mobileNumber" class="form-control w-80" required>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                                                    style="max-height:200px; overflow: scroll">
                                                    <li v-for="country in allCountries" @click="currentCountry = country; mobileNumber = country.dialCode">
                                                        <a class="dropdown-item d-flex" href="#">
                                                            <div :class="'vti__flag '+ ( country.iso2.toLowerCase() )"></div>
                                                            {{ country.name }} {{ "+"+country.dialCode }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
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
                                        <input type="checkbox" class="form-check-input" name="agreeCheckboxUser" checked id="agree_checkbox_user">
                                        <label class="form-check-label" for="agree_checkbox_user">I agree to Quraan edu</label> <router-link to="/privacy_policy">Privacy Policy</router-link> &amp; <router-link to="/terms"> Terms.</router-link>
                                    </div>
                                </div>
                                <button class="btn btn-primary login-btn" type="submit" :disabled="wait" id="submit">{{ wait ? "waiting.." : "Create Account" }}</button>
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

    import allCountries from "../../allCountries";
    import timeZones from "../../timeZones";
    export default {
        data(){
            return{
                formData:{
                    name:"",
                    email:"",
                    mobile_number:null,
                    country:"",
                    city:"",
                    timeZone:"",
                    timeZoneOffset:"",
                    password:"",
                    password_confirmation:"",
                },
                errors:{},
                allCountries:allCountries,
                currentCountry:{},
                mobileNumber:"",
                wait:false,
            }
        },
        methods:{
            registerForm(){
                this.formData.mobile_number = this.mobileNumber.toString().replace("+","");
                this.formData.country = this.currentCountry.name.split(" ")[0];
                if(this.formData.mobile_number.substring(0,2) == this.currentCountry.dialCode) {
                    this.sendRegisterForm();
                }else{
                    alert("Mobile format is incorrect.. It should be your country dial code then your number");
                }

            },
            async sendRegisterForm(){
                this.wait = true;
                await axios.post('/api/register',this.formData)
                    .then((res) =>{
                        this.$store.commit("get_token",res.data.token);
                        this.$store.commit("get_current_user",res.data.user);
                        this.$router.push("/");

                        window.axios.defaults.headers.common['Authorization'] = 'Bearer '+res.data.token;
                    })
                    .catch((err)=>{
                        this.errors = err.response.data.errors;
                        this.wait = false;
                    })
            },
            countryChanged(phone, phoneObject, input){
                if (phoneObject?.formatted) {
                    this.formData.mobile_number = phoneObject.countryCallingCode + phoneObject.nationalNumber
                }
                if(phoneObject.country.name){
                    this.formData.country = phoneObject.country.name.split("(") ?
                        phoneObject.country.name.split("(")[0].trim() : phoneObject.country.name.trim();
                }

            },
            setTimeZone(){
                var tz = jstz.determine();
                this.formData.timeZone = tz.name();
                for (let zone of timeZones){
                    if (zone.utc.includes(this.formData.timeZone)){
                        this.formData.timeZoneOffset = zone.text.split(" ")[0];
                    }
                }
            },

        },
        watch:{
            mobileNumber(){
                let code = this.mobileNumber.toString().replace("+","");
                if (!this.mobileNumber){
                    this.currentCountry = {};
                }

                for (let country of this.allCountries){
                    if (
                        country.dialCode == code.substring(0,1) ||
                        country.dialCode == code.substring(0,2) ||
                        country.dialCode == code.substring(0,3) ||
                        country.dialCode == code.substring(0,4)
                    ){
                        this.currentCountry = country;
                    }
                }

            },
        },
        mounted(){
            this.setTimeZone();

        }
    }
</script>


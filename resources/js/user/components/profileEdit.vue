<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <h3>Control Your Profile</h3>
        <div class="card">
            <div class="card-body">

                <form @submit.prevent="editProfileData" enctype="multipart/form-data">
                    <div class="row form-row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <div class="change-avatar">
                                    <div class="profile-img">
                                        <img v-if="$store.state.currentUser.profile_image" :src="'profile_images/' + $store.state.currentUser.profile_image" id="showImage" :alt="$store.state.currentUser.name">
                                        <img v-else id="showImage" src="/profile_images/avatar.png" alt="avatar">
                                    </div>
                                    <div class="upload-img">
                                        <div class="change-photo-btn">
                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                            <input type="file" class="upload" id="image" name="profile_image" @change="showImage">
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG or PNG. Max size of 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="formData.name" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="formData.email" required>
                            </div>
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label class="form-control-label">Mobile Number</label>-->
<!--                            <vue-tel-input styleClasses="form-control"-->
<!--                                           invalidMsg="invalid Number"-->
<!--                                           :value="formData.mobile_number"-->
<!--                                           @input="countryChanged"-->
<!--                                           enabledCountryCode="true"></vue-tel-input>-->
<!--                        </div>-->

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="dropdown d-flex ">
                                                <span class="btn btn-outline-primary dropdown-toggle d-flex w-20 pt-2 border" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <div :class="'mt-1 ml-2 vti__flag '+ ( (currentCountry.iso2 ?? allCountries[0].iso2).toLowerCase() )"></div>
                                                </span>

                                        <input type="tel" placeholder="write your number" v-model="mobile_number" class="form-control w-80" required>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                                            style="max-height:200px; overflow: scroll">
                                            <li v-for="country in allCountries" @click="currentCountry = country; this.mobile_number = country.dialCode">
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

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <select name="" class="form-control m-auto" id="timezone" @change="formData.timezone_offset = $event.currentTarget.selectedOptions[0].attributes[0].value"
                                        v-model="formData.timezone">
                                    <template v-for="timezone in timeZones">
                                        <option :value="utc" :selected="utc == $store.state.currentUser.timezone"
                                                :timezone_offset="timezone.text.split(' ')[0]"
                                                v-for="utc in timezone.utc">{{ utc + " " + timezone.text.split(' ')[0] }}</option>
                                    </template>
                                </select>
                            </div>
                        </div>

<!--                        <div class="col-12 col-md-6">-->
<!--                            <div class="form-group">-->
<!--                                <label>Name</label>-->
<!--                                <input type="text" class="form-control" :value="formData.name">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-12 col-md-6">-->
<!--                            <div class="form-group">-->
<!--                                <label>City</label>-->
<!--                                <input type="text" class="form-control" value="Old Forge">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-12 col-md-6">-->
<!--                            <div class="form-group">-->
<!--                                <label>State</label>-->
<!--                                <input type="text" class="form-control" value="Newyork">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-12 col-md-6">-->
<!--                            <div class="form-group">-->
<!--                                <label>Zip Code</label>-->
<!--                                <input type="text" class="form-control" value="13420">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-12 col-md-6">-->
<!--                            <div class="form-group">-->
<!--                                <label>Country</label>-->
<!--                                <input type="text" class="form-control" value="United States">-->
<!--                            </div>-->
<!--                        </div>-->
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
    import timeZones from "../../timeZones";
    import allCountries from "../../allCountries";
    export default {
        data(){
            return{
                timeZones:timeZones,
                formData:{
                    "name":this.$store.state.currentUser.name,
                    "email":this.$store.state.currentUser.email,
                    "mobile_number":this.$store.state.currentUser.mobile_number,
                    "country" : this.$store.state.currentUser.country,
                    "timezone" : this.$store.state.currentUser.timezone,
                    "timezone_offset" : this.$store.state.currentUser.timezone_offset,
                },
                mobile_number:"",
                currentCountry:{},
                allCountries:allCountries,
            }
        },
        methods:{
            countryChanged(phone, phoneObject, input){
                console.log(phoneObject);
                console.log(phone);
                if (phoneObject?.formatted) {
                    this.formData.mobile_number = phoneObject.formatted
                }
                if(phoneObject.country.name){
                    this.formData.country = phoneObject.country.name.split("(") ?
                        phoneObject.country.name.split("(")[0].trim() : phoneObject.country.name.trim();
                }

            },
            editProfileData(event){

                if(this.mobile_number.toString().replace("+","").substring(0,2) == this.currentCountry.dialCode) {

                    this.formData.country = this.currentCountry.name.split(" ")[0];
                    this.formData.mobile_number = this.mobile_number.toString().replace("+", "");

                    let myForm = new FormData(event.currentTarget);
                    myForm.append("country", this.formData.country);
                    myForm.append("mobile_number", this.formData.mobile_number);
                    myForm.append("name", this.formData.name);
                    myForm.append("email", this.formData.email);
                    myForm.append("timezone", this.formData.timezone);
                    myForm.append("timezone_offset", this.formData.timezone_offset);

                    axios.post("/api/editProfile", myForm)
                        .then((res) => {
                            // console.log(res);
                            alert("Profile has been updated successfully");
                            this.$store.commit("get_current_user",res.data);
                            this.$router.push("/");
                        })
                        .catch((error) => {
                            // console.log(error);
                        });
                }else{
                    alert("Mobile format is incorrect.. It should be your country dial code then your number");
                }

            },
            showImage(e){
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.querySelector('#showImage').src = e.target.result;
                        document.getElementById("showImage").style.display = "block";
                    }
                    reader.readAsDataURL(e.target.files['0']);
            },
        },
        watch:{
           formData: {
             handler:function (newValue) {
                 // console.log(document.getElementById("timezone").selectedOptions[0].attributes[0].value);
                 // this.FormData.timezone_offset =  document.getElementById("timezone").selectedOptions[0].getAttribute('timezone_offset')
                 console.log(newValue);
             },
              deep:true
          } ,
            mobile_number(){
                let code = this.mobile_number.toString().replace("+","");
                if (!this.mobile_number){
                    this.currentCountry = {};
                }

                // if(!this.currentCountry.iso2){
                for (let country of this.allCountries){
                    if (
                        country.dialCode == code.substring(0,1) ||
                        country.dialCode == code.substring(0,2) ||
                        country.dialCode == code.substring(0,3) ||
                        country.dialCode == code.substring(0,4)
                    ){
                        this.currentCountry = country;
                        // this.mobile_number = country.dialCode
                    }
                }
                // }

            },

        },
        beforeMount() {
            this.mobile_number = this.$store.state.currentUser.mobile_number;
        }
    }
</script>

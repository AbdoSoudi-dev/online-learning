<template>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <form @submit.prevent="addUserForm">
                <div class="row">
                    <div class="col-6 mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="formData.name" required>
                        <label for="" class="text-danger" v-if="errors.name"> {{ errors.name[0] }}</label>
                    </div>
                    <div class="col-6 mb-3">
                        <label >Email</label>
                        <input type="email" class="form-control" v-model="formData.email" required>
                        <label for="" class="text-danger" v-if="errors.email"> {{ errors.email[0] }}</label>

                    </div>
                </div>

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

                <div class="row">
                    <div class="col-6 mb-3 my-auto">
                        <label>User Role</label>
                        <select name="" id="" class="form-control" v-model="formData.role_id">
                            <option value="">Choose</option>
                            <option value="1">user</option>
                            <option value="2">admin</option>
                            <option value="3">superAdmin</option>
                        </select>
                        <label for="" class="text-danger" v-if="errors.role_id"> {{ errors.role_id[0] }}</label>
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
                </div>
        <button class="btn btn-primary" type="submit">Edit user</button>
    </form>
        </div>
    </div>
</template>

<script>
    import allCountries from "../../allCountries";
    import timeZones from "../../timeZones";

    export default {
        name: "addUser",
        data(){
            return{
                formData:{
                    id: this.$route.params.id,
                    name:"",
                    email:"",
                    mobile_number:null,
                    country:"",
                    city:"",
                    role_id:"",
                    timezone:"",
                    timezone_offset:"",
                },
                errors:{},
                timeZones:timeZones,
                allCountries:allCountries,
                currentCountry:{},
                mobile_number:"",
            }
        },
        methods:{
           async addUserForm(){
                this.formData.mobile_number = this.mobile_number.toString().replace("+","");
                this.formData.country = this.currentCountry.name.split(" ")[0];
                if(this.formData.mobile_number.substring(0,2) == this.currentCountry.dialCode) {
                   await axios.post('/api/edit_user',this.formData)
                         .then((res) =>{
                             alert("Profile has been updated successfully");
                             this.$router.push("../users")
                         })
                         .catch((err)=>{
                             this.errors = err.response.data.errors;
                         })
                }else{
                    alert("Mobile format is incorrect.. It should be your country dial code then your number");
                }
            },
            setTimeZone(){
                var tz = jstz.determine();
                this.formData.timeZone = tz.name();
                for (let zone of timeZones){
                    if (zone.utc.includes(this.formData.timeZone)){
                        this.formData.timezone_offset = zone.text.split(" ")[0];
                    }
                }
            },
            async getUser(){
                await axios.get(`/api/user/${this.$route.params.id}`)
                      .then((res) =>{
                          this.formData.name = res.data.name;
                          this.formData.email = res.data.email;
                          this.mobile_number = res.data.mobile_number;
                          this.formData.country = res.data.country;
                          this.formData.role_id = res.data.role_id;
                          this.formData.timezone = res.data.timezone;
                          this.formData.timezone_offset = res.data.timezone_offset;
                      })
            }
        },
        watch:{
            mobile_number(){
                let code = this.mobile_number.toString().replace("+","");
                if (!this.mobile_number){
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
        beforeMount(){
            this.getUser();
        }
    }
</script>

<style scoped>

</style>

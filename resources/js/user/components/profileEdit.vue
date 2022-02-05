<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <h3>Control Your Profile</h3>
        <div class="card">
            <div class="card-body">

                <form>
                    <div class="row form-row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <div class="change-avatar">
                                    <div class="profile-img">
                                        <img src="assets/img/user/user.jpg" alt="User Image">
                                    </div>
                                    <div class="upload-img">
                                        <div class="change-photo-btn">
                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                            <input type="file" class="upload">
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" :value="formData.name">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" :value="formData.email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Mobile Number</label>
                            <vue-tel-input styleClasses="form-control"
                                           invalidMsg="invalid Number"
                                           :value="formData.mobile_number"
                                           @input="countryChanged"
                                           enabledCountryCode="true"></vue-tel-input>
                        </div>
<!--                        <div class="col-12">-->
<!--                            <div class="form-group">-->
<!--                                <label>Address</label>-->
<!--                                <input type="text" class="form-control" value="806 Twin Willow Lane">-->
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
    export default {
        data(){
            return{
                formData:{
                    "name":this.$store.state.currentUser.name,
                    "email":this.$store.state.currentUser.email,
                    "mobile_number":this.$store.state.currentUser.mobile_number,
                    "country" : this.$store.state.currentUser.country,
                    "timezone" : this.$store.state.currentUser.timezone,
                    "timezone_offset" : this.$store.state.currentUser.timezone_offset,
                }
            }
        },
        methods:{
            countryChanged(phone, phoneObject, input){
                console.log(phoneObject);
                console.log(phone);
                // if (phoneObject?.formatted) {
                //     this.formData.mobile_number = phoneObject.formatted
                // }
                // if(phoneObject.country.name){
                //     this.formData.country = phoneObject.country.name.split("(") ?
                //         phoneObject.country.name.split("(")[0].trim() : phoneObject.country.name.trim();
                // }

            },
        }
    }
</script>

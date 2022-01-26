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
                    <div class="col-6 mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" v-model="formData.password" required>
                        <label for="" class="text-danger" v-if="errors.password"> {{ errors.password[0] }}</label>
                    </div>
                    <div class="col-6 mb-3">
                        <label >Confirm Password</label>
                        <input type="password" class="form-control" v-model="formData.password_confirmation" required>
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
                </div>
        <button class="btn btn-primary" type="submit">Add user</button>
    </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "addUser",
        data(){
            return{
                formData:{
                    name:"",
                    email:"",
                    password:"",
                    password_confirmation:"",
                    role_id:""
                },
                errors:{}
            }
        },
        methods:{
            addUserForm(){
                axios.post('/api/addUser',this.formData).then((res) =>{
                    // console.log(res)
                    alert("User has been added successfully");
                    this.$router.push("users")
                }).catch((err)=>{
                    // console.log(err)
                    this.errors = err.response.data.errors;
                })
            }
        }
    }
</script>

<style scoped>

</style>

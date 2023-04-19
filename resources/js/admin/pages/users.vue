<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Users</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="text-right"  >
                    <router-link to="add_user">
                        <i style="cursor: pointer" class="fas fa-plus text-light bg-success ml-2 fa-3x p-2"></i>
                    </router-link>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created_at</th>
                                            <th>Roles</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(user,key) in users">
                                            <td>{{ key+1 }}</td>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td>{{ user.updated_at.split("T")[0] }}</td>
                                            <td>{{ user.role.title }}</td>
                                            <td style="cursor: pointer;">
                                                <router-link :to="'edit_user/'+user.id">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </router-link>
                                            </td>
                                            <td style="cursor: pointer;">
                                                <i class="fas fa-trash-alt text-danger" @click="deleteUser(user.id)"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>


    export default {

        name: "users",
        components:{

        },
        data(){
            return{
                users:[],
            }
        },
        methods:{
            async getUsers(){
                await axios.get('/api/users')
                         .then((res)=>{
                             this.users = res.data;
                         })
            },
           async deleteUser(userId){
               await axios.post("/api/remove_user",{
                         id : userId
                     }).then((res)=>{
                        this.users = this.users.filter( x => x.id != userId );
                        alert("User deleted successfully");
                    })
            }
        },
        beforeMount() {
            this.getUsers();
        }
    }
</script>

<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Bookings List </h4>
                    <div class="form-group" v-if="[2,3].includes($store.state.currentUser.role_id)">
                        <h4>Choose User</h4>
                        <select class="form-control m-auto" @change="getBookingTimes" v-model="user_id">
                            <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-center mb-0">
                                <thead>
                                    <tr class="text-bold text-center text-light bg-primary">
                                        <td>#</td>
                                        <td>Course</td>
                                        <td>Time</td>
                                        <td>Count</td>
                                        <td>Next lecture</td>
                                        <td width="35%">Process</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(list,key) in bookingsList" class="text-center">
                                        <td>{{ (key+1) }}</td>
                                        <td>{{ list.course.title }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="col-8">
                                                    <span v-for="day in list.timing.days">
                                                        {{ day }}
                                                        <br>
                                                    </span>
                                                </div>
                                                <div class="col-4">
                                                    {{ formatAMPM(list.timing.time) }}
                                                </div>
                                            </div>

                                        </td>
                                        <td>(12/{{ list.session_num-1 }})</td>
                                        <td>{{ (list.diff_time ?? "expired") }}</td>
                                        <td >
                                            <div class="pro-progress ">
                                                <div class="tooltip-toggle" tabindex="0" :style="'width:' + Math.round((list.session_num-1)*100/12) + '% !important' ">

                                                </div>
                                                <div class="tooltip" :style="'left:' + (+Math.round((list.session_num-1)*100/12) -7) + '% !important' ">{{ Math.round((list.session_num-1)*100/12) + "%" }}</div>
                                            </div>
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
</template>

<script>
    export default {
        data(){
            return{
                bookingsList:[],
                user_id:this.$store.state.currentUser.id,
                users:[]
            }
        },
        methods:{
            getUsers(){
                axios.get('/api/users')
                    .then((res)=>{
                        // console.log(res)
                        this.users = res.data;
                    })
                    .catch((err)=>{

                    })
            },
            getBookingsList(){
                axios.get("/api/bookings_list/"+this.user_id)
                    .then((res)=>{
                        console.log(res);
                        this.bookingsList = res.data;
                    })
                    .catch((error)=>{
                        // console.log(error);
                    })
            },
            formatAMPM(date) {
                date = new Date(date);
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0'+minutes : minutes;
                var strTime = hours + ':' + minutes + ' ' + ampm;
                return strTime;
            },

        },
        beforeMount() {
            this.getUsers();
            this.getBookingsList();
        }
    }
</script>
<style scoped>

    .tooltip-toggle{
        height: 8px;
        background-color: #1e88e5;
        line-height: 8px;
        color: white;
        text-align: center;
        border-radius: 4px;
    }

</style>

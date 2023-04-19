<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Bookings List </h4>
                    <div class="form-group" v-if="$store.state.currentUser.role_id == 2 || $store.state.currentUser.role_id == 3">
                        <h4>Choose User</h4>
                        <select class="form-control m-auto"
                                @change="getUsersAndBookingsListAndCheckPayments(false)" v-model="user_id">
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
                                        <td v-if="payments.count"> Unpaid </td>
                                        <td>Next lecture</td>
                                        <td width="35%">Process</td>
                                        <td v-if="$store.state.currentUser.role_id === 3">delete</td>
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
                                                    {{ formatAMPM(list.session_date) }}
                                                </div>
                                            </div>

                                        </td>
                                        <td>( {{ (list.timing.days.length * 4) }} /{{ list.session_num-1 }})</td>
                                        <td v-if="payments.count">
                                            <div class="btn btn-danger" v-if="payments[list.booking_group_id]">
                                                <router-link :to="'/payment/'+payments[list.booking_group_id].id">
                                                    <span class="text-light">
                                                        Pay
                                                    </span>
                                                </router-link>
                                            </div>
                                        </td>
                                        <td>{{ (list.diff_time ?? "expired") }}</td>
                                        <td >
                                            <div class="pro-progress ">
                                                <div class="tooltip-toggle" tabindex="0"
                                                     :style="'width:' + Math.round((list.session_num-1)*100/(list.timing.days.length * 4)) + '% !important' ">

                                                </div>
                                                <div class="tooltip"
                                                     :style="'left:' + (+Math.round((list.session_num-1)*100/(list.timing.days.length * 4)) -7) + '% !important' ">
                                                    {{ Math.round((list.session_num-1)*100/(list.timing.days.length * 4)) + "%" }}
                                                </div>
                                            </div>
                                        </td>

                                        <td v-if="$store.state.currentUser.role_id === 3">
                                            <i class="fas fa-trash-alt fa-2x text-danger cursor-pointer" @click="deleteBooking(list.booking_group_id)"
                                               v-if="payments[list.booking_group_id]"></i>
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
                users:[],
                payments:[],
                isAdmin: ( this.$store.state.currentUser.role_id == 2
                           || this.$store.state.currentUser.role_id == 3 )
            }
        },
        methods:{
            async getUsersAndBookingsListAndCheckPayments(isAdmin){
                await Promise.all([
                    axios.get(`/api/check_payments/${this.user_id}`),
                    axios.get(`/api/bookings_list/${this.user_id}`),
                    isAdmin ? axios.get('/api/users') : [],
                ]).then((response)=>{
                    this.payments = response[0].data;
                    this.bookingsList = response[1].data;
                    this.users = response[2].data ?? this.users;
                });
            },
            formatAMPM(date) {
                date = new Date(date);
                let hours = date.getHours();
                let minutes = date.getMinutes();
                let ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0'+minutes : minutes;
                let strTime = hours + ':' + minutes + ' ' + ampm;
                return strTime;
            },
            async deleteBooking(booking_group_id){
                await Promise.all([
                    axios.delete(`/api/delete_booking/${booking_group_id}`),
                    this.getUsersAndBookingsListAndCheckPayments(false),
                ])
            }

        },
        beforeMount() {
            this.getUsersAndBookingsListAndCheckPayments(this.isAdmin);
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

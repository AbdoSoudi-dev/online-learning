<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Your lectures </h4>
                            <div class="form-group" v-if="$store.state.currentUser.role_id == 2 || $store.state.currentUser.role_id == 3">
                                <h4>Choose User</h4>
                                <select class="form-control m-auto" @change="getBookingTimes();checkPayments()" v-model="user_id" >
                                    <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12 m-auto text-center" >
                                <h4 class="">
                                    Now, we are waiting for you in the coming class, Be there on time.
                                </h4>
                                <h6>
                                    Note: These times are detected based on you timezone {{ $store.state.currentUser.timezone_offset }}
                                    You can change it from <router-link class="text-bold text-primary" to="/profile">HERE</router-link>.
                                </h6>
                            </div>
                        </div>

                        <div class="row" v-if="payments.count && $store.state.currentUser.free_trail == 1">
                            <div class="col-12 m-auto text-center" >
                                <h5 class="text-danger">Already used free trail. You must pay then lectures open</h5>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr class="text-center text-bold text-light bg-primary">
                                        <td>Course</td>
                                        <td>Time</td>
                                        <td>Date</td>
                                        <td>Day</td>
                                        <td v-if="payments.count">Unpaid</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(book,booking_group_id) in myBookingTimes">
                                    <tr class="text-center " v-for="(courseTime,key) in book">
                                        <td style="vertical-align: middle" v-if="key ==0" :rowspan="book.length">
                                            {{ courseTime.course.title }}
                                        </td>
                                        <td style="vertical-align: middle" v-if="key ==0" :rowspan="book.length">
                                            {{ formatAMPM(courseTime.session_time) }}
                                            <br>
                                            <span class="text-danger">
                                                For {{ courseTime.duration }} mins
                                            </span>
                                        </td>
                                        <td>
                                            {{ courseTime.session_date }}
                                        </td>
                                        <td>{{ courseTime.day }}</td>
                                        <td v-if="payments.count && key ==0" style="vertical-align: middle" :rowspan="book.length">
                                            <div class="btn btn-danger" v-if="payments[booking_group_id]">
                                                <router-link :to="'/payment/'+payments[booking_group_id].id">
                                                    <span class="text-light">
                                                        Pay
                                                    </span>
                                                </router-link>
                                            </div>
                                        </td>
                                        <td>
                                            <span @click="setPresented(courseTime.id,courseTime.present,courseTime.meeting.meeting_id)" class="text-light p-2 bg-info cursor-pointer"
                                                  v-if="courseTime.current && ( $store.state.currentUser.free_trail ==0 || ($store.state.currentUser.free_trail ==1 && payments[booking_group_id]) )">
                                                Join Now
                                            </span>
                                            <span class="btn btn-dark" v-else-if="$store.state.currentUser.free_trail ==1 && payments[booking_group_id]">
                                                Closed
                                            </span>
                                            <span v-else :class="'text-light p-2 '+
                                                (courseTime.current || courseTime.coming ? 'bg-info r' : (courseTime.status === 'expired' ? 'bg-danger' : 'bg-secondary') ) "
                                                  style="border-radius: 5px">
                                                    {{ courseTime.current ? "Join Now"
                                                    : ( courseTime.coming ? "coming" : courseTime.status  ) }}
                                                <!--                                                </a>-->
                                            </span>
                                        </td>
                                    </tr>
                                </template>
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
                myBookingTimes:[],
                user_id:this.$store.state.currentUser.id,
                users:[],
                interval:"",
                payments:[]
            }
        },
        methods:{
            async getUsers(){
                if (this.$store.state.currentUser.role_id != 1) {
                    const responseUsers = await axios.get('/api/users');
                    this.users = await responseUsers.data;
                }
            },
            async getBookingTimes(){
                const responseBookingTimes = await axios.get("/api/bookings/"+this.user_id);
                this.myBookingTimes = await responseBookingTimes.data;
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
            async setPresented(booking_id,present,meeting_id){
                if (present == 0 || this.$store.state.currentUser.free_trail == 0){
                    await axios.post("/api/bookings_presenting",{
                              booking_id: booking_id
                          })
                          .then((res)=>{
                              this.$store.commit("get_current_user",res.data);
                              window.open("/joinRoom/"+meeting_id)
                          })
                }
            },
            async checkPayments(){
                const responsePayments = await axios.get("/api/check_payments/"+this.user_id);
                this.payments = await responsePayments.data;
            }
        },
        beforeMount() {
            this.checkPayments();
            this.getBookingTimes();
            this.getUsers();

          this.interval = setInterval(()=>{
                if (!document.hidden){
                    this.getBookingTimes()
                }
            },20000);
        },
        unmounted() {
            clearInterval(this.interval);
        }
    }
</script>

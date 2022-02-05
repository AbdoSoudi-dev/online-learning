<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Your lectures </h4>
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr class="text-center text-bold text-light bg-primary">
                                        <td>Course</td>
                                        <td>Time</td>
                                        <td>Date</td>
                                        <td>Day</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody v-for="(book,key) in myBookingTimes">
                                    <tr class="text-center " v-for="(courseTime,key) in book">
                                        <td style="vertical-align: middle" v-if="key ==0" rowspan="12">
                                            {{ courseTime.course.title }}
                                        </td>
                                        <td style="vertical-align: middle" v-if="key ==0" rowspan="12">
                                            {{ formatAMPM(courseTime.timing.time) }}
                                        </td>
                                        <td>{{ courseTime.session_date }}</td>
                                        <td>{{ courseTime.day }}</td>
                                        <td>
                                            <span :class="'text-light p-2 '+
                                            (courseTime.current || courseTime.coming ? 'bg-info' : (courseTime.status === 'expired' ? 'bg-danger' : 'bg-secondary') ) "
                                                  style="border-radius: 5px">
                                                 {{ courseTime.current ? "Join Now"
                                                : ( courseTime.coming ? "coming" : courseTime.status  ) }}
                                            </span>
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
                myBookingTimes:[]
            }
        },
        methods:{
            getBookingTimes(){
                axios.get("/api/bookings")
                    .then((res)=>{
                        console.log(res);
                        this.myBookingTimes = res.data;
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
            this.getBookingTimes();
        }
    }
</script>

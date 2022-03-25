<template>
    <section class="section path-section" v-if="courseDetails.removed == 0">
        <div class="section-header">
            <div class="container">
<!--                <span class="text-bold">lorem aaaa</span>-->
                <h2 class="text-center" v-if="$store.state.currentUser.free_trail == 1"></h2>
                <h2 class="text-center" v-else>Start Free Trial!</h2>
            </div>
        </div>
        <div class="learning-path-col">
            <div class="container">
                <div class="row d-flex justify-content-center">

                    <div class="col-12 col-md-4 col-lg-3" >
                        <div class="large-col">
                            <router-link :to="'/course/'+courseDetails.id">
                                <div class="image-col-merge">
                                    <img :src="'/courses/'+courseDetails.image" alt="">
                                    <div class="text-col">
                                        <h5>{{courseDetails.title}}</h5>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="row" v-if="courseDetails.removed == 0">
        <div class="col-md-8 col-12 m-auto ">
            <div class="card">

                <div class="col-12 m-auto text-center mt-2">
                    <h4 class="text-bold text-black">
                        Choose your suitable time from our times
                    </h4>
                    <h6>
                        Note: These times are detected based on you timezone {{ $store.state.currentUser.timezone_offset }}
                              You can change it from <router-link class="text-bold text-primary" to="/profile">HERE</router-link>
                    </h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-hover table-bordered">
                            <thead>
                                <tr class="text-light bg-primary text-bold">
                                    <td class="text-center">Days</td>
                                    <td class="text-center"> Time </td>
                                    <td class="text-center"> Price </td>
                                    <td class="text-center"> Detect </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="timing in timingsZone">

                                    <td >
                                        <div class="d-flex row justify-content-center">
                                            <div class="col-4" v-for="daily in timing.days">
                                                {{ daily }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
<!--                                        {{ timing.time }}-->
                                        <input type="time" class="form-control time_timing">
                                    </td>
                                    <td class="text-center text-success">{{ timing.price + "$" }}</td>
                                    <td class="text-center text-success">
<!--                                        <span v-if="checkTiming.includes(timing.id)">-->
<!--                                            Already detected-->
<!--                                        </span>-->
                                        <span v-if="wait">
                                            Waiting
                                        </span>
                                        <i v-else
                                           @click="saveBooking(timing.id,$event)" class="fas fa-sign-in-alt text-success fa-2x cursor-pointer"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <h1 v-else-if="courseDetails.removed == 1" class="text-danger text-center mt-3 mx-auto h-75vh">
        Unavailable Course
    </h1>
</template>

<script>

    export default {
        name: "enrollCourse",
        data(){
            return{
                courseDetails:{},
                timings:[],
                checkTiming:[],
                wait:false
            }
        },
        methods:{
            getCourseDetails(){
                axios.get("/api/courses/"+this.$route.params.id)
                    .then((res)=>{
                        // console.log(res);
                        this.courseDetails = res.data;
                    })
                    .catch((err)=>{
                        // console.log(err);
                    })
            },
            all_timings(){
                axios.get("/api/timings").then((res)=>{
                    // console.log(res);
                    this.timings = res.data;
                }).catch((error)=>{
                    console.log(error);
                })
            },
            check_token_time(){
                axios.post("/api/check_times",{
                    course_id : this.$route.params.id
                }).then((res)=>{
                    // console.log(res);
                    this.checkTiming = res.data;
                }).catch((error)=>{
                    console.log(error);
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
            saveBooking(timing_id,event){
                let inputTime = event.currentTarget.parentNode.parentNode.children[1].children[0];
                let time = inputTime.value;

                if (time) {
                    this.wait = true;
                    axios.post("/api/bookings", {
                        timing_id: timing_id,
                        time: time,
                        course_id: this.$route.params.id
                    }).then((res) => {
                        // console.log(res);
                        this.$router.push("/schedule-timings");
                    })
                        .catch((err) => {
                            // console.log(err);
                            alert("Something went wrong");
                            this.wait = false;
                        })
                }else{
                    inputTime.style = "transform: scale(1.5);transition: all 1s ease-in-out;";
                    alert("detect you suitable time, please!");

                    setTimeout(()=>{
                        inputTime.style = "transform: scale(1);transition: all 1s ease-in-out;";
                    },500);

                }
            },

        },
        beforeMount() {
            this.getCourseDetails();
            this.all_timings();
            // this.check_token_time();
        },
        computed:{
            timingsZone(){
                let timing = [];
                for (let i = 0; i < this.timings.length; i++) {
                    const time = this.timings[i];
                    time.time = this.formatAMPM(time.time);
                    timing.push({...time});
                }
                return timing;
            }
        },
        mounted() {

        }
    }

</script>

<style scoped>
    .h-75vh{
        height: 75vh;
    }
</style>

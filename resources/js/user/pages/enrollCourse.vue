<template>
    <section class="section path-section" v-if="courseDetails.removed == 0">
        <div class="section-header">
            <div class="container">
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
                                <tr v-for="(timing,key) in timingsEdited">

                                    <td >
                                        <div class="d-flex row justify-content-center m-auto">
                                            <div class="col-md-4 col-12" v-for="daily in timing.days">
                                                {{ daily }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center timting_duration">
                                        <input type="time" class="form-control time_timing">
                                        <br>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-6 position-relative">
                                                <input type="radio" :id="'hour'+key" :name="'duration'+key" value="60" v-model="timing.duration">
                                                <label :for="'hour'+key" class="col-12">60 mins</label>
                                            </div>
                                            <div class="col-6 position-relative">
                                                <input type="radio" :id="'half-hour'+key" :name="'duration'+key" value="30" v-model="timing.duration">
                                                <label :for="'half-hour'+key" class="col-12">30 mins</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-bold text-center text-success">{{ (timing.duration == 30 ? (timing.price / 2) : timing.price )+ " $" }}</td>
                                    <td class="text-center text-success">
                                        <span v-if="wait">
                                            Waiting
                                        </span>
                                        <i v-else
                                           @click="prepareToSaveBooking(timing.id,timing.duration,$event)" class="fas fa-sign-in-alt text-success fa-2x cursor-pointer"></i>
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
                wait:false,
                timingsEdited:[]
            }
        },
        methods:{
            async getCourseDetails() {
                const responseCourseDetails = await axios.get("/api/courses/" + this.$route.params.id);
                this.courseDetails = responseCourseDetails.data;
            },
            async allTimings(){
                await axios.get("/api/timings")
                    .then(res =>{
                        this.timings = res.data;
                        this.timingsZone();
                    })
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
            prepareToSaveBooking(timing_id,duration,event){
                this.wait = true;
                let inputTime = event.currentTarget.parentNode.parentNode.children[1].children[0];

                if (inputTime.value) {
                    this.saveBooking({
                        timing_id: timing_id,
                        time: inputTime.value,
                        duration: duration,
                        course_id: this.$route.params.id
                    });
                }else{
                    inputTime.style = "transform: scale(1.5);transition: all 1s ease-in-out;";
                    alert("detect you suitable time, please!");

                    setTimeout(()=>{
                        inputTime.style = "transform: scale(1);transition: all 1s ease-in-out;";
                    },500);

                }
            },
            async saveBooking(data){
                await axios.post("/api/bookings", data)
                    .then((res) => {
                        this.$router.push("/schedule_timings");
                    })
                    .catch((err) => {
                        alert("Something went wrong");
                        this.wait = false;
                    })
            },
            timingsZone(){
                let timing = [];
                for (let i = 0; i < this.timings.length; i++) {
                    const time = this.timings[i];
                    time.time = this.formatAMPM(time.time);
                    time.duration = 60;
                    timing.push({...time});
                }
                this.timingsEdited =  timing;
            }

        },
        beforeMount() {
            this.getCourseDetails();
            this.allTimings();
        },
    }

</script>

<style scoped>
    .h-75vh{
        height: 75vh;
    }
    td{
        vertical-align: middle;
    }
    tr{
        border-bottom: 1px solid #009efb !important;
    }
/*    input radio */
    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }
    [type="radio"]:checked + label,
    [type="radio"]:not(:checked) + label
    {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }
    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 18px;
        height: 18px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }
    [type="radio"]:checked + label:after,
    [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 12px;
        height: 12px;
        background: #F87DA9;
        position: absolute;
        top: 3px;
        left: 3px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
    .timting_duration{
        min-width: 161px;
    }
</style>

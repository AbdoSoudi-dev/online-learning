<template>
    <section class="section path-section mt-3">
        <div class="section-header">
            <div class="container">
                <span class="text-bold">lorem aaaa</span>
                <h2 class="text-center">Start Free Trial!</h2>
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

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-hover table-bordered">
                            <thead>
                            <tr class="text-primary">
                                <td class="text-center" colspan="3">Days</td>
                                <td class="text-center"> Time </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="timing in timingsZone">
                                <td v-for="daily in timing.days">{{ daily }} </td>

                                <td>{{ timing.time }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "enrollCourse",
        data(){
            return{
                courseDetails:{},
                timings:[],
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
                    console.log(res);
                    this.timings = res.data;
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
        },
        beforeMount() {
            this.getCourseDetails();
            this.all_timings();
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
    }

</script>

<style scoped>

</style>

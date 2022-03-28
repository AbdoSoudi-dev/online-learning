<template>

    <section v-if="courseDetails.removed == 0" class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row ">
                                <div class="blog-details d-flex row justify-content-center">

                                    <div class="col-md-4 col-12">
                                        <h2 class="col-12 text-bold text-center mb-2 text-primary">{{ courseDetails.title }}</h2>
                                        <img class="img-fluid raduis" :src="'/courses/'+courseDetails.image" :alt="courseDetails.title">


                                        <div class="row">
                                            <div class="col-10" style="margin: 15px 30px 0 30px;">
                                                <div class="row border-style">
                                                    <h5 class="col-12 text-primary mb-0 mt-2">
                                                        <i class="fas fa-long-arrow-alt-right  text-primary"></i>
                                                        (30/60) mins
                                                    </h5>
                                                    <h5 class="col-12 text-primary m-0">
                                                        <i class="fas fa-long-arrow-alt-right  text-primary"></i>
                                                        1 Free trial class
                                                    </h5>
                                                    <h5 class=" col-12 text-primary">
                                                        <i class="fas fa-long-arrow-alt-right  text-primary"></i>
                                                        Classes around the clock
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <div class="mt-2 mx-auto">
                                                <!--                                            <div class="col-6 ">-->
                                                <!--                                                <h3 class="text-success text-bold m-2" v-if="courseDetails.price">-->
                                                <!--                                                    {{ courseDetails.price + ' $' }}-->
                                                <!--                                                </h3>-->
                                                <!--                                            </div>-->
                                                <!--                                            <div class="col-6">-->
                                                <button class="btn btn-success col-6 m-auto" @click="enrollCourse" v-if="$store.state.currentUser.free_trail == 1">
                                                    Enroll Now
                                                </button>
                                                <button class="btn btn-success col-6 m-auto" @click="enrollCourse" v-else>
                                                    Free Trial
                                                </button>
                                                <!--                                            </div>-->
                                            </div>

                                        </div>
                                    </div>
                                    <div class="blog-content col-md-8 col-12"  v-html="courseDetails.description">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <h1 v-else-if="courseDetails.removed == 1" class="text-danger text-center mt-3 mx-auto h-75vh">
        Unavailable Course
    </h1>
</template>

<script>
    export default {
        name: "courseDetails",
        data(){
            return{
                courseDetails:{},
                courseId:this.$route.params.id,
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
            enrollCourse(){
              if (this.$store.state.token){
                  this.$router.push("/enrollCourse/"+this.courseId);
              }else{
                  this.$router.push("/register");
              }
            },
        },
        watch:{
            $route (to, from){
                if (to.params.id != from.params.id){
                    this.getCourseDetails();
                }
            }
        },
        beforeMount() {
            this.getCourseDetails();
        },
    }
</script>

<style scoped>
    .h-75vh{
        height: 75vh;
    }

    .btn-success{
        background: #16A086 !important;
    }
    .btn-success:hover{
        background: #000 !important;
    }
    .border-style{
        border: 1.8px solid #16A086;
        border-radius: 10px;
        margin-left: 3px;
    }
    .raduis{
        border-radius: 10px;
    }
</style>

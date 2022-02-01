<template>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mt-5">
                                <span class="course-title col-12">{{ courseDetails.title }}</span>
                                <div class="blog-details d-flex row justify-content-center">

                                    <div class="col-md-4 col-12">
                                        <img class="img-fluid" :src="'/courses/'+courseDetails.image" :alt="courseDetails.title">
                                        <div class="col-12 mt-3 d-flex justify-content-center">
<!--                                            <div class="col-6 ">-->
                                                <h3 class="text-success text-bold m-2" v-if="courseDetails.price">
                                                    {{ courseDetails.price + ' $' }}
                                                </h3>
<!--                                            </div>-->
<!--                                            <div class="col-6">-->
                                                <button class="btn btn-success" @click="enrollCourse" v-if="$store.state.currentUser.free_trial == 1">
                                                    Enroll Now
                                                </button>
                                                <button class="btn btn-success" @click="enrollCourse" v-else>
                                                    Free Trial
                                                </button>
<!--                                            </div>-->
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
                console.log(to.params.id);
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

</style>

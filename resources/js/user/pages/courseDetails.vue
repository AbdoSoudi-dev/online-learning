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
                courseId:this.$route.params.id,
                courseDetails:{},

            }
        },
        methods:{
            getCourseDetails(){
                axios.get("/api/courses/"+this.courseId)
                     .then((res)=>{
                         // console.log(res);
                         this.courseDetails = res.data;
                     })
                    .catch((err)=>{
                        // console.log(err);
                    })
            }
        },
        beforeMount() {
            this.getCourseDetails();
        }
    }
</script>

<style scoped>

</style>

<template>
    <section class="section path-section mt-3">
        <div class="section-header text-center">
            <div class="container">
                <span>Choose the</span>
                <h2>Different All Learning Paths</h2>
                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>
            </div>
        </div>
        <div class="learning-path-col">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-4 col-lg-3" v-for="course in coursesList">
                        <div class="large-col">
                            <router-link :to="'/course/'+course.id">
                                <div class="image-col-merge">
                                    <img :src="'/courses/'+course.image" alt="">
                                    <div class="text-col">
                                        <h5>{{course.title}}</h5>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>


<script>
    export default {
            data(){
                return{
                    coursesList:[]
                }
            },
            methods:{
                getCourses(){
                    axios.get("/api/courses")
                        .then((res)=>{
                            this.coursesList = res.data;
                        })
                        .catch((err)=>{
                            // console.log(err);
                        });
                }
            },
            beforeMount() {
                this.getCourses();
            }
        }

</script>

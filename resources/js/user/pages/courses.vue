<template>
    <section class="section path-section bg-gray-dark">
        <div class="section-header text-center">
            <div class="container">
                <span v-if="!$store.state.currentUser.free_trail || $store.state.currentUser.free_trail == 0">
                    Learn Online.. and Enjoy Learning.
                </span>
                <h2>Courses</h2>
                <p class="sub-title">
                    Schedule your Free Trial Now.
                </p>
            </div>
        </div>
        <div class="learning-path-col">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-4 col-lg-3" v-for="course in coursesList">
                        <div class="large-col text-center">
                            <router-link :to="'/course/'+course.id">
                                <div class="image-col-merge img_course" >
                                    <img :src="'/courses/'+course.image" alt="" >
                                    <div class="text-col">
                                        <h5 class="title">{{course.title}}</h5>
                                        <p class="sub-title short_desc mt-4">
                                            {{ course.short_desc }}
                                        </p>
                                    </div>
                                </div>
                                <div class="btn btn-success text-bold mt-2 w-100">More Details</div>
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
<style scoped>

    .img_course{
        position: relative;
        border-radius: 15px;
    }

    .short_desc {
        /*background: rgba(29, 106, 154, 0.72);*/
        color: #fff;
        display: none;
        opacity: 0;
        font-weight: bolder;
        width: 63%;
        margin: auto;
        border: 1px solid #fff;
        border-radius: 13px;
        padding: 4px;
        /* transition effect. not necessary */
        transition: opacity .7s, display .7s;
    }

    .img_course:hover .short_desc {
        display: block;
        opacity: 1;
    }
    .bg-gray-dark{
        background-color: #e4f2ff;
    }
    .btn-success{
        background: #16A086 !important;
    }
    .btn-success:hover{
        background: #000 !important;
    }
    .title{
        font-size: 28px !important;
    }
</style>

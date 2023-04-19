<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Courses</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">
                                <router-link to="/admin" class="text-primary">Dashboard</router-link> / Courses
                             </li>

                        </ul>
                    </div>
                    <div class="col-12">
                        <router-link to="addCourse">
                            <i style="cursor: pointer" class="fas fa-plus text-light bg-success ml-2 fa-3x p-2"></i>
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">

                                <div class="col-12 col-md-6 col-xl-4" v-for="(course,key) in courses" :key="key">
                                    <div class="course-box blog grid-blog">
                                        <div class="blog-image mb-0">
                                            <a><img class="img-fluid" height="300px"
                                                    :src="'/courses/'+course.image" :alt="course.title"></a>
                                        </div>
                                        <div class="course-content">
                                            <span class="date">{{ course.updated_at.split("T")[0] }}</span>
                                            <span class="course-title">{{ course.title }}</span>
                                            <p v-html="course.description" id="description"></p>
                                            <div class="row">
                                                <div class="col">
                                                    <a class="text-success">
                                                        <router-link :to="'editCourse/'+course.id">
                                                            <i class="far fa-edit"></i> Edit
                                                        </router-link>
                                                    </a>
                                                </div>
                                                <div class="col text-end">
                                                    <a href="javascript:void(0);" @click="inactiveCourse(course.id)" class="text-danger">
                                                        <i class="far fa-trash-alt"></i> Inactive
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

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
                courses:[]
            }
        },
        methods:{
            async myCourses(){
                const reponseCourses = await axios.get("/api/courses");
                this.courses = await reponseCourses.data;
            },
            async inactiveCourse(id){
                if (confirm("Are you sure?")){
                    await axios.put(`/api/course_destroy/${id}`)
                    .then(res=>{
                        this.myCourses();
                    })
                }
            }
        },
        beforeMount() {
            this.myCourses();
        }
    }
</script>

<style scoped>
    #description{
        height: 90px;
        width: 100%;
        overflow-y:scroll;
        overflow-x:hidden;
        word-wrap: break-spaces;
    }
</style>

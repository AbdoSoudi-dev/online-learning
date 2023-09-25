<template>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <form @submit.prevent="addCourseForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6 mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="course.title" name="title" required>
                        <label for="" class="text-danger" v-if="errors.title"> {{ errors.title[0] }}</label>
                    </div>
                    <div class="col-6 mb-3">

                    </div>
                    <div class="col-6 mb-3">
                        <label>Short Description</label>
                        <textarea class="form-control" name="short_desc" v-model="course.short_desc" required></textarea>
                        <label class="text-danger" v-if="errors.short_desc"> {{ errors.short_desc[0] }}</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <h5>Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input id="image" type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-6" >
                        <img id="showImage" :src="'/courses/'+course.image" style="width:100px; height: 100px;" alt="">
                    </div>
                </div>

                <div class="row" v-if="loaded">
                    <div class="col-12 mb-5">
                        <QuillEditor contentType="html" v-model:content="description" toolbar="full"></QuillEditor>
                    </div>
                </div>


                <div class="row mt-5">
                    <button class="btn btn-primary col-md-3 col-3 m-auto " type="submit">Edit Course</button>
                </div>

            </form>
        </div>
    </div>
</template>
<script>

    import '@vueup/vue-quill/dist/vue-quill.snow.css';
    import { QuillEditor } from '@vueup/vue-quill'
    export default {
        name: "editCourse",
        components:{
            QuillEditor
        },
        data(){
            return{
                description:"",
                errors:[],
                loaded:false,
                course:{}
            }
        },
        methods:{
            showImage(){
                document.querySelector('#image')
                    .addEventListener("change",function (e) {
                        console.log(e.currentTarget)
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.querySelector('#showImage').src = e.target.result;
                        document.getElementById("showImage").style.display = "block";
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            },
            async addCourseForm(e){
                let formData = new FormData(e.currentTarget);
                formData.append("description",this.description);
                formData.append("id",this.$route.params.id);

                await axios.post('/api/course_update',formData)
                      .then(res=>{
                          this.$router.push("../courses");
                      })

            },
            async getCourseDetails(){
                await axios.get(`/api/courses/${this.$route.params.id}`)
                      .then((res)=>{
                          this.course = res.data;
                          this.description = res.data.description;
                          this.loaded = true
                       })
            },
        },
        mounted() {
            this.getCourseDetails();
            this.showImage();
        },
    }
</script>

<style scoped>

</style>

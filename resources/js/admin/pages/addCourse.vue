<template>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <form @submit.prevent="addCourseForm" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6 mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                        <label for="" class="text-danger" v-if="errors.title"> {{ errors.title[0] }}</label>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" required>
                        <label for="" class="text-danger" v-if="errors.price"> {{ errors.price[0] }}</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <h5>Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input id="image" type="file" name="image" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" >
                        <img id="showImage" src="" style="width:100px; height: 100px; display: none" alt="">
                    </div>
                </div>

                <div class="row" >
                    <div class="col-12 mb-5">
                        <QuillEditor contentType="html" v-model:content="description" toolbar="full"></QuillEditor>
                    </div>
                </div>


                <div class="row mt-5">
                    <button class="btn btn-primary col-md-3 col-3 m-auto " type="submit">Add Course</button>
                </div>

<!--                <div class="row">-->
<!--                    <div class="col-12 " v-html="description">-->
<!--                    </div>-->
<!--                </div>-->

            </form>
        </div>
    </div>
</template>
<script>
    import { QuillEditor } from '@vueup/vue-quill'
    import '@vueup/vue-quill/dist/vue-quill.snow.css';

    export default {
        name: "addCourse",
        components:{
            QuillEditor
        },
        data(){
            return{
                description:"",
                errors:[],
            }
        },
        methods:{
            showImage(){
                document.querySelector('#image')
                    .addEventListener("change",function (e) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.querySelector('#showImage').src = e.target.result;
                        document.getElementById("showImage").style.display = "block";
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            },
            addCourseForm(e){
                let formData = new FormData(e.currentTarget);
                formData.append("description",this.description);

                axios.post('/api/courses',formData)
                     .then((res)=>{
                         // console.log(res);
                         this.$router.push("courses");
                     })
                     .catch((err)=>{
                         // console.log(err);
                     })

            },
        },
        watch:{
            description(){
                console.log(this.description);
            },
        },
        mounted() {
            this.showImage();
        },
    }
</script>

<style scoped>

</style>

<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Our Timings</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="text-right"  >
                        <i style="cursor: pointer" data-bs-toggle="modal" href="#timeModal"
                           @click="actionType = 'Add'"
                           class="fas fa-plus text-light bg-success ml-2 fa-3x p-2"></i>
                </div>
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

        </div>
    </div>


    <div class="modal fade" id="timeModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ actionType }} Timing</h5>
                    <button type="button" class="close" id="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form v-if="actionType === 'Add'" @submit.prevent="addTime">
                        <div class="row form-row">
                            <div class="col-12 ">
                                <div class="form-group m-auto">
                                    <label class="col-12 text-bold">Days</label>
                                    <select name="days" class="form-control mb-2" v-model="day" :disabled="days.length == 3">
                                        <option value="">{{ days.length == 3 ? '3 days Chosen' : "~~Choose Day~~" }}</option>
                                        <option value="Sunday">Sunday</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                    </select>
                                    <div class="row d-flex justify-content-between mb-2 mx-auto col-md-8 col-12"
                                         v-for="(day,key) in days" :key="key">
                                          <div class="col-6 text-center">{{ day }}</div>
                                        <i @click="deleteDay(day)" class="col-6 text-center fas fa-trash-alt text-danger cursor-pointer"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-auto">
                                    <label class="col-12"> Time </label>
                                    <input type="time" class="form-control text-center" v-model="time">
                                </div>
                            </div>


                        </div>

                        <button type="submit" v-if="days.length == 3 && time"
                                class="btn btn-primary btn-block w-100 mt-3">{{ actionType }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "timings",
        data(){
            return{
                actionType:"",
                day:"",
                time:"",
                days:[],
                timings:[]
            }
        },
        methods:{
            deleteDay(oldDay){
                this.days = this.days.filter( day => oldDay != day);
            },
            all_timings(){
                axios.get("/api/timings").then((res)=>{
                    console.log(res);
                    this.timings = res.data;
                }).catch((error)=>{
                    console.log(error);
                })
            },
            addTime(){

                axios.post("/api/timings",{
                    days:this.days,
                    time:this.time
                }).then((res)=>{
                    console.log(res);

                    document.getElementById('close').click();

                    this.days = [];
                    this.time = "";

                    this.all_timings();
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
            }
        },
        watch:{
            day(){
                if(this.day){
                    if (this.days.length < 3){
                        if(this.days.includes(this.day)){
                            this.day = "";
                            alert("Already Chosen");
                        }else{
                            this.days.push(this.day);
                            this.day = "";
                        }
                    }else{
                        this.day = "";
                        alert("3 days only");
                    }
                }

            }
        },
        beforeMount() {
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
        }

    }
</script>

<style scoped>

</style>

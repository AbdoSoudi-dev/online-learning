<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Create Meetings</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="col-12 text-center mt-2 mx-auto" v-if="checkedBookings.length">
                            <h4 class="btn btn-outline-primary text-bold" data-bs-toggle="modal" href="#createMeeting">
                                Create Meeting
                            </h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr class="bg-primary text-light text-bold text-center">
                                            <td>#</td>
                                            <td>Name</td>
                                            <td>Course</td>
                                            <td>Date</td>
                                            <td>Time</td>
                                            <td>Check</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center" v-for="(book,key) in comingBookings">
                                            <td>{{ (key+1) }}</td>
                                            <td>{{ book.user.name }}</td>
                                            <td>{{ book.course.title }}</td>
                                            <td>{{ book.session_date.split(" ")[0] }}</td>
                                            <td>{{ formatAMPM(book.session_date) }}</td>
                                            <td>
                                                <input v-if="(!checkedBookings.length || (checkedBookings.length && checkedBookings[0].session_date == book.session_date ))
                                                                && !book.meetings.length "
                                                       class="form-check-input cursor-pointer" type="checkbox" @change="checkBook" :bookingKey="key">
                                                <span v-else-if="book.meetings.length" class="text-success"> Done </span>
                                            </td>
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


    <div class="modal fade" id="createMeeting" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Meeting For {{ checkedBookings.length }} Member</h5>
                    <button type="button" class="close" id="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-if="checkedBookings.length">
                    <form @submit.prevent="createMeeting()">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 mt-2">
                                <label for="topic">Topic</label>
                                <input type="text" id="topic" class="form-control" :value="checkedBookings[0].course.title" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="duration">Duration <small>*min</small></label>
                                <input type="number" id="duration" class="form-control" :value="checkedBookings[0].duration" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="start_at">Start at</label>
                                <input type="datetime-local" id="start_at" class="form-control" :value="checkedBookings[0].meeting_date" readonly required>
                            </div>
                            <div class="col-12 mt-2 mx-auto text-center">
                                <input type="submit" class="form-control btn btn-outline-success" :disabled="wait" :value="wait ? 'waiting' : 'Create Meeting'">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "createMeetings",
        data(){
            return{
                comingBookings:[],
                checkedBookings:[],
                wait:false
            }
        },
        methods:{
            getComingBookings(){
                axios.get("/api/coming_bookings").then((res)=>{
                    // console.log(res);
                    this.comingBookings = res.data;
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
            checkBook(event){
                let booking = this.comingBookings[event.currentTarget.getAttribute("bookingKey")];
                if (event.currentTarget.checked){
                    this.checkedBookings.push(booking);
                }else{
                    this.checkedBookings = this.checkedBookings.filter(x=> x.id != booking.id);
                }

            },
            createMeeting(){
                this.wait = true;
                axios.post("/api/create_meeting",{
                    bookings:this.checkedBookings.map(x => x.id),
                    topic:document.getElementById("topic").value,
                    duration:document.getElementById("duration").value,
                    start_at:this.checkedBookings[0].session_date,
                }).then((res)=>{
                    // console.log(res);
                    this.wait = false;
                    this.$router.push("/admin/meetings");

                })
            }
        },
        beforeMount() {
            this.getComingBookings();
        }
    }
</script>

<style scoped>

</style>

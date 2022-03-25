<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Meetings</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="text-right"  >
                    <router-link to="new_meeting">
                        <i style="cursor: pointer" class="fas fa-plus text-light bg-success ml-2 fa-3x p-2"></i>
                    </router-link>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-bordered">
                                    <thead>
                                    <tr class="text-primary text-center">
                                        <th>#</th>
                                        <td>Topic</td>
                                        <td>Start at</td>
                                        <td>Bookings</td>
                                        <td> start meeting</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center" v-for="(meeting,key) in meetings">
                                            <td>{{ key+1 }}</td>
                                            <td>{{ meeting.topic }}</td>
                                            <td>{{ meeting.start_at }}</td>
                                            <td>
                                                <div class="row d-flex justify-content-center">
                                                    <h5 class="col-6" v-for="booking in meeting.bookings">
                                                        {{ booking.user.name }}
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>
                                                <a :href="'/joinRoom/'+meeting.meeting_id" class="btn btn-info text-light">Start</a>
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
</template>

<script>
    export default {
        name: "meetings",
        data(){
            return{
                meetings:[],
            }
        },
        methods:{
            getMeetings(){
                axios.get("/api/meetingsAll").then((res)=>{
                    // console.log(res.data);
                    this.meetings = res.data;
                })
            }
        },
        mounted() {
            this.getMeetings();
        }
    }
</script>

<style scoped>

</style>

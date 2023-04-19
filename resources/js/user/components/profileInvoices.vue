<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card card-table">
            <div class="card-body">
                <h4 class="card-title m-2">Your Payments</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                            <tr class="bg-primary text-bold text-light text-center">
                                <td>Payment ID</td>
                                <td>Course Title</td>
                                <td>PayPal Email</td>
                                <td>Amount</td>
                                <td>Paid On</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center" v-for="pay in payments">
                                <td>{{ pay.payment_id }}</td>
                                <td>
                                    <router-link :to="'/course/'+pay.booking.course.id">
                                        {{ pay.booking.course.title }}
                                    </router-link>
                                </td>
                                <td>{{ pay.email_address }}</td>
                                <td class="text-success">{{ pay.amount + " $" }}</td>
                                <td>{{ dateFormat(pay.created_at) }}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                payments:[]
            }
        },
        methods:{
            async myPayments(){
                 const responsePayments = await axios.get("/api/my_payments");
                 this.payments = await responsePayments.data;
            },
            dateFormat(date){
                date = new Date(date);
                let month = date.getMonth();
                let day = date.getUTCDate();
                let year = date.getUTCFullYear();

                const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ];

                return  day + " " + monthNames[month] + " " + year;
            }
        },
        beforeMount() {
            this.myPayments();
        }
    }
</script>

<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Payments Report</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0">
                                    <thead>
                                        <tr class="text-center text-light bg-info text-bold">
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Course Title</th>
                                            <th>Payment ID</th>
                                            <th>PayPal Email</th>
                                            <th>PayPal User</th>
                                            <th>Amount</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center" v-for="(invoice,key) in invoices">
                                            <td>{{ key+1 }}</td>
                                            <td>{{ invoice.user.name }}</td>
                                            <td>{{ invoice.booking.course.title }}</td>
                                            <td>{{ invoice.payment_id }}</td>
                                            <td>{{ invoice.email_address }}</td>
                                            <td>{{ invoice.name }}</td>
                                            <td class="text-success">{{ invoice.amount + "$" }}</td>
                                            <td>{{ dateFormat(invoice.created_at) }}</td>
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
        name: "invoices",
        data(){
            return{
                invoices:[]
            }
        },
        methods:{
            getPayments(){
                axios.get("/api/paymentsAdmin").then((res)=>{
                    this.invoices = res.data;
                })
            },
            dateFormat(date){
                date = new Date(date);
                var month = date.getMonth();
                var day = date.getUTCDate();
                var year = date.getUTCFullYear();

                const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ];

                return  day + " " + monthNames[month] + " " + year;
            }
        },
        beforeMount() {
            this.getPayments();
        }
    }
</script>

<style scoped>

</style>

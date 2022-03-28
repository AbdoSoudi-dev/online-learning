<template>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h4 class="breadcrumb-title">Pay via PayPal </h4>
                </div>
                <div class="col-md-7 col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group card-label">
                                        <label class="text-black text-black">Course Title</label>
                                        <input class="form-control" :value="bookingData.course?.title" type="text" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group card-label">
                                        <label class="text-black text-black">Booking Date</label>
                                        <input class="form-control" :value="bookingData.created_at?.split('T')[0]" type="text" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group card-label">
                                        <label class="text-black text-black">Course Days</label>
                                        <input class="form-control" :value="bookingData.timing?.days" type="text" readonly>
                                    </div>
                                </div>
                                 <div class="col-md-6 col-sm-12">
                                    <div class="form-group card-label">
                                        <label class="text-black text-black">Course Time</label>
                                        <input class="form-control" :value="formatAMPM(bookingData.timing?.time)" type="text" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-6 col-12">
                                        <div id="your-container-element"></div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 theiaStickySidebar">

                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Booking Summary</h4>
                        </div>
                        <div class="card-body">

                            <div class="booking-user-info">
                                <a class="booking-user-img">
                                    <img class="rounded-circle" :src="'/profile_images/' + $store.state.currentUser.profile_image" v-if="$store.state.currentUser.profile_image" width="31" :alt="$store.state.currentUser.name">
                                    <img v-else src="/profile_images/avatar.png" width="31" class="rounded-circle" alt="avatar">
                                </a>
                                <div class="booking-info mt-2">
                                    <h4><a class="text-capitalize"> {{ $store.state.currentUser.name }}</a></h4>
                                    <div class="mentor-details">
                                        <p class="user-location"><i class="fas fa-map-marker-alt mr-2"></i>{{ $store.state.currentUser.country }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="booking-summary mt-2">
                                <div class="booking-item-wrap">
                                    <ul class="booking-date">
                                        <li>Date <span>{{ dateDay }}</span></li>
                                        <li>Time <span>{{ dateHours }}</span></li>
                                        <li>Duration <span>{{ bookingData.duration }}</span></li>
                                    </ul>
                                    <ul class="booking-fee">
                                        <li>Course amount <span>{{ (bookingData.timing ? (bookingData.duration == "60" ? bookingData.timing.price : (bookingData.timing.price/2) ): 0) + "$" }}</span></li>
                                    </ul>
                                    <div class="booking-total">
                                        <ul class="booking-total-list">
                                            <li>
                                                <span>Total</span>
                                                <span class="total-cost">{{ (bookingData.timing ? (bookingData.duration == "60" ? bookingData.timing.price : (bookingData.timing.price/2) ): 0) + "$" }}</span>
                                            </li>
                                        </ul>
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

    import router from "../../router/router";

    export default {
        name: "payment",
        data(){
            return{
                bookingData:{},
                dateDay:"",
                dateHours:"",
            }
        },
        methods:{
            loadPaypalScript(){
                const script = document.createElement("script");
                script.src =
                    "https://www.paypal.com/sdk/js?client-id=AUDUxtbSB7Lt1wgPHnyVd2xLTziX0A0MSsZYkclJdpCWC6RYOaUmSomUbXlIudr7FsdXn5Le9-_koRHc";
                script.id = "paypal_script";
                // AWVtRxX_6Ekx_x9dME6zWgJ6BDKa_tAFZtsJgQ1FmNwWvHBGo-FvutOYiTib1Xm_OncTr4i-OcbegdFz
            // &disable-funding=credit,card

                script.addEventListener("load", this.setPayload);
                document.body.appendChild(script);
            },
            getBookingData(){
                axios.get("/api/bookingsPayCheck/"+this.$route.params.booking_id)
                     .then((res)=>{
                         // console.log(res);
                         this.bookingData = res.data;
                         this.loadPaypalScript();
                     }).catch((err)=>{
                        this.$router.push("/invoices");
                     })
            },
            setPayload(){
                let booking_id = this.$route.params.booking_id;
                let user_id = this.$store.state.currentUser.id;
                let price = (this.bookingData.duration == "60" ? this.bookingData.timing?.price : (this.bookingData.timing?.price / 2) );
                let booking_group_id = this.bookingData.booking_group_id;

                paypal.Buttons({
                    createOrder: function(data, actions) {
                        // Set up the transaction
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    currency_code:"USD",
                                    value: price
                                }
                            }]
                        });
                    },

                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function (details) {
                            console.log(data)

                            let paypalData = {};
                            paypalData.email_address = details.payer.email_address;
                            paypalData.name = details.payer.name.given_name;
                            paypalData.country_code = details.payer.address.country_code;
                            paypalData.payer_id = details.payer.payer_id;
                            paypalData.payment_id = details.id;
                            paypalData.amount = price;
                            paypalData.booking_group_id = booking_group_id;
                            paypalData.booking_id = booking_id;
                            paypalData.user_id = user_id;

                            // console.log(paypalData);
                            //send data to save
                            axios.post("/api/setPayment",paypalData)
                                .then((res)=>{
                                    // console.log(res)
                                    router.push("/invoices");
                                })
                                .catch((err)=>{
                                    // console.log(err);
                                })

                            alert('Transaction completed, Thanks ' + details.payer.name.given_name);
                        });
                    },
                    onError: function (err) {
                        alert("Something went wrong, Please try again")
                        console.log(err);
                    }

                }).render('#your-container-element');
            },
            formatDate() {
                let date = new Date();
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0'+minutes : minutes;

                this.dateHours =  hours + ':' + minutes + ' ' + ampm;

                var month = date.getMonth();
                var day = date.getUTCDate();
                var year = date.getUTCFullYear();

                const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ];

                this.dateDay = day + " " + monthNames[month] + " " + year;

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
        },
        beforeMount() {
            this.getBookingData();
            this.formatDate();
        },
        unmounted() {
            if(document.getElementById("paypal_script")){
                document.getElementById("paypal_script").remove();
            }

        }

    }
</script>

<style scoped>

</style>

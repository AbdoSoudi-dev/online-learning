<template>
    <section class="section path-section bg-gray-dark">
        <div class="section-header text-center">
            <div class="container">
<!--                <span>Choose the</span>-->
                <h2>Pricing</h2>
<!--                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</p>-->
            </div>
        </div>

        <div class="pricing-area">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3 class="mb-1">1 DAY / WEEK</h3>
                                <h4>30<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                   <li> WeekEnd availability </li>
                                   <li> 1 Free Trial </li>
                                   <li> 1 Lesson / Week </li>
                                   <li> 60 Minutes Class </li>
                                   <li> 4 Hours / Month </li>
                                </ul>
                                <div class="btn-area">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3 class="mb-1">2 DAYS / WEEK</h3>
                                <h4>60<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                   <li> WeekEnd availability </li>
                                   <li> 1 Free Trial </li>
                                   <li> 60 Minutes Class </li>
                                   <li> 8 Hours / Month </li>
                                   <li> Joining Friend Availability </li>
                                </ul>
                                <div class="btn-area">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3 class="mb-1">3 DAYS / WEEK</h3>
                                <h4>84<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                  <li> 1 Free Trial </li>
                                  <li> 60 Minutes Class </li>
                                  <li> 12 Hours / Month </li>
                                  <li> Joining Friend Availability </li>
                                  <li> 24 Hours Support </li>
                                </ul>
                                <div class="btn-area">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3 class="mb-1">4 DAYS / WEEK</h3>
                                <h4>112<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                  <li> 1 Free Trial </li>
                                  <li> 60 Minutes Class </li>
                                  <li> 16 Hours / Month </li>
                                  <li> Joining Friend Availability </li>
                                  <li> 24 Hours Support </li>
                                </ul>
                                <div class="btn-area">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price">
                            <div class="deal-top">
                                <h3 class="mb-1">5 DAYS / WEEK</h3>
                                <h4>140<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom">
                                <ul class="deal-item">
                                  <li> 1 Free Trial </li>
                                  <li> 60 Minutes Class </li>
                                  <li> 20 Hours / Month </li>
                                  <li> Joining Friend Availability </li>
                                  <li> 24 Hours Support </li>
                                </ul>
                                <div class="btn-area">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


        </div>



    <!--  half an hour  -->
        <div class="pricing-area">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price single-price-half">
                            <div class="deal-top-half">
                                <h3 class="mb-1">1 DAY / WEEK</h3>
                                <h4>15<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom-half">
                                <ul class="deal-item">
                                    <li> WeekEnd availability </li>
                                    <li> 1 Free Trial </li>
                                    <li> 1 Lesson / Week </li>
                                    <li> 30 Minutes Class </li>
                                    <li> 2 Hours / Month </li>
                                </ul>
                                <div class="btn-area-half">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price single-price-half">
                            <div class="deal-top-half">
                                <h3 class="mb-1">2 DAYS / WEEK</h3>
                                <h4>30<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom-half">
                                <ul class="deal-item">
                                    <li> WeekEnd availability </li>
                                    <li> 1 Free Trial </li>
                                    <li> 30 Minutes Class </li>
                                    <li> 4 Hours / Month </li>
                                    <li> Joining Friend Availability </li>
                                </ul>
                                <div class="btn-area-half">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price single-price-half">
                            <div class="deal-top-half">
                                <h3 class="mb-1">3 DAYS / WEEK</h3>
                                <h4>42<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom-half">
                                <ul class="deal-item">
                                    <li> 1 Free Trial </li>
                                    <li> 30 Minutes Class </li>
                                    <li> 6 Hours / Month </li>
                                    <li> Joining Friend Availability </li>
                                    <li> 24 Hours Support </li>
                                </ul>
                                <div class="btn-area-half">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price single-price-half">
                            <div class="deal-top-half">
                                <h3 class="mb-1">4 DAYS / WEEK</h3>
                                <h4>56<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom-half">
                                <ul class="deal-item">
                                    <li> 1 Free Trial </li>
                                    <li> 30 Minutes Class </li>
                                    <li> 8 Hours / Month </li>
                                    <li> Joining Friend Availability </li>
                                    <li> 24 Hours Support </li>
                                </ul>
                                <div class="btn-area-half">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-price single-price-half">
                            <div class="deal-top-half">
                                <h3 class="mb-1">5 DAYS / WEEK</h3>
                                <h4>70<span class="sup">$</span> </h4>
                            </div>
                            <div class="deal-bottom-half">
                                <ul class="deal-item">
                                    <li> 1 Free Trial </li>
                                    <li> 30 Minutes Class </li>
                                    <li> 10 Hours / Month </li>
                                    <li> Joining Friend Availability </li>
                                    <li> 24 Hours Support </li>
                                </ul>
                                <div class="btn-area-half">
                                    <router-link to="/coursesList" v-if="$store.state.currentUser.role_id">
                                        Enroll Course
                                    </router-link>
                                    <router-link to="/register" v-else>
                                        Sign Up
                                    </router-link>
                                </div>
                            </div>
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

            },
            beforeMount() {

            }
        }

</script>
<style scoped>
    .single-price {
        text-align: center;
        background: #fff;
        transition: .7s;
        margin-top: 20px;
    }
    .single-price h3 {
        font-size: 25px;
        color: #000;
        font-weight: 600;
        text-align: center;
        margin: 0;
        margin-top: -80px;
        font-family: poppins;
        color: #fff;
    }
    .single-price h4 {
        font-size: 48px;
        font-weight: 500;
        color: #fff;
    }
    .single-price h4 span.sup {
        vertical-align: text-top;
        font-size: 25px;
    }
    .deal-top {
        position: relative;
        background: #16A086;
        font-size: 16px;
        text-transform: uppercase;
        padding: 136px 24px 0;
    }
    .deal-top::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -50px;
        width: 0;
        height: 0;
        border-top: 50px solid #16A086;
        border-left: 175px solid transparent;
        border-right: 183px solid transparent;
    }
    .deal-bottom {
        padding: 56px 16px 0;
    }
    .deal-bottom ul {
        margin: 0;
        padding: 0;
    }
    .deal-bottom  ul li {
        font-size: 16px;
        color: #000;
        font-weight: 300;
        margin-top: 16px;
        border-top: 1px solid #E4E4E4;
        padding-top: 16px;
        list-style: none;
    }
    .btn-area a {
        display: inline-block;
        font-size: 18px;
        color: #fff;
        background: #16A086;
        padding: 8px 64px;
        margin-top: 32px;
        border-radius: 4px;
        margin-bottom: 40px;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
    }


    .single-price:hover {
        background: #16A086;
    }
    .single-price:hover .deal-top {
        background: #262626;
    }
    .single-price:hover .deal-top:after {
        border-top: 50px solid #262626;
    }
    .single-price:hover .btn-area a {
        background: #262626;
    }





    /* ignore the code below */

    .link-area
    {
        position:fixed;
        bottom:20px;
        left:20px;
        padding:15px;
        border-radius:40px;
        background:tomato;
    }
    .link-area a
    {
        text-decoration:none;
        color:#fff;
        font-size:25px;
    }

/*    half an hour design */

    .deal-top-half {
        position: relative;
        background: #009efb ;
        font-size: 16px;
        text-transform: uppercase;
        padding: 136px 24px 0;
    }
    .deal-top-half::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -50px;
        width: 0;
        height: 0;
        border-top: 50px solid #009efb ;
        border-left: 175px solid transparent;
        border-right: 183px solid transparent;
    }
    .deal-bottom-half {
        padding: 56px 16px 0;
    }
    .deal-bottom-half ul {
        margin: 0;
        padding: 0;
    }
    .deal-bottom-half  ul li {
        font-size: 16px;
        color: #000;
        font-weight: 300;
        margin-top: 16px;
        border-top: 1px solid #E4E4E4;
        padding-top: 16px;
        list-style: none;
    }
    .btn-area-half a {
        display: inline-block;
        font-size: 18px;
        color: #fff;
        background: #009efb;
        padding: 8px 64px;
        margin-top: 32px;
        border-radius: 4px;
        margin-bottom: 40px;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
    }
    .single-price:hover .btn-area-half a {
        background: #262626;
    }
    .single-price-half:hover {
        background: #009efb !important;
    }

    .single-price-half:hover .btn-area-half a {
        background: #fff;
        color: #000;
    }

    .single-price:hover .deal-top-half {
        background: #262626;
    }
    .single-price:hover .deal-top-half:after {
        border-top: 50px solid #262626;
    }
</style>

<template>
    <section class="section section-search">
        <div class="container">
            <div class="banner-wrapper m-auto text-center">
                <div class="banner-header">
                    <h1> <span class="text-uppercase text-light title-style">  Quraan edu</span></h1>
                    <h2 class="text-light bg-darked">
                        Online Institute provides live classes for All ages,for you and your kids with a highly qualified native tutors from <span class="text-bold">Al-Azhar</span> in Egypt for Quraan and Islam "all in one".
                    </h2>
                </div>

            </div>
        </div>
    </section>

    <section class="section how-it-works">
        <div class="container">
            <div class="section-header text-center">
                <h2>Who we are?</h2>
                <p class="sub-title">We are an online institute providing online classes "All in One"</p>
            </div>

            <div class="row m-auto " style="font-size: 18px !important;">
                <div class="row d-flex justify-content-center">

                    <div class="col-md-4 col-12 mb-3 d-block d-md-none">
                        <img src="/mosque-vector.png" class="img-fluid">
                    </div>

                    <div class="col-md-7 col-12">
                        <p class="sub-title" v-for="item in descriptionItems">
                            {{ item }}
                        </p>
                    </div>

                    <div class="col-md-1 d-none-d-md-block"></div>

                    <div class="col-md-4 col-12 mt-5 d-none d-md-block">
                        <img src="/mosque-vector.png" class="img-fluid" >
                    </div>

                </div>
            </div>
        </div>
    </section>

    <courses></courses>

    <section class="section how-it-works">
        <div class="container">
            <div class="section-header text-center">
                <span>Quraan Edu</span>
                <h2>How does it work?</h2>
            </div>
            <div class="row justify-content-center">

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="feature-header">
                            <div class="feature-icon">
                                <span class="circle"></span>
                                <i class="fas fa-street-view text-warning"></i>
                            </div>
                            <div class="feature-cont">
                                <div class="feature-text">
                                    Welcome to our website
                                </div>
                                <p class="text-secondary">
                                    Feel Free to check Our website as it's designed in a smooth way to make it easy for you to use.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="feature-header">
                            <div class="feature-icon">
                                <span class="circle"></span>
                                <i class="fas fa-bars-staggered text-success"></i>
                            </div>
                            <div class="feature-cont">
                                <div class="feature-text">
                                    Confirm your Course
                                </div>
                                <p class="text-secondary">
                                    please check and choose your suitable course that you need and tab on Free Trial, you will be asked to Register.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="feature-header">
                            <div class="feature-icon">
                                <span class="circle"></span>
                                <i class="fas fa-calendar-day text-info"></i>
                            </div>
                            <div class="feature-cont">
                                <div class="feature-text">
                                    Time and Days
                                </div>
                                <p class="text-secondary">
                                    You will go to choose your days and the time that suits you and then wait for free trial date.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="feature-header">
                            <div class="feature-icon">
                                <span class="circle"></span>
                                <i class="fas fa-hourglass text-warning"></i>
                            </div>
                            <div class="feature-cont">
                                <div class="feature-text">
                                    Join your Free Trial
                                </div>

                                <p class="text-secondary">
                                    Once your Free Trial date comes, Join the class from your Meetings page, your Teacher will be waiting for you.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="feature-header">
                            <div class="feature-icon">
                                <span class="circle"></span>
                                <i class="fas fa-dollar-sign text-success"></i>
                            </div>
                            <div class="feature-cont">
                                <div class="feature-text">
                                    Pay your Fees
                                </div>
                                <p class="text-secondary">
                                    After finishing your class you will be directed to pay your Fees to Unlock the rest of the course.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature-box text-center">
                        <div class="feature-header">
                            <div class="feature-icon">
                                <span class="circle"></span>
                                <i class="fas fa-project-diagram text-info"></i>
                            </div>
                            <div class="feature-cont">
                                <div class="feature-text">
                                    Your Course is Unlocked
                                </div>
                                <p class="text-secondary">
                                    Congratulations, The process is Completed, you are now one of our Family, enjoy your journey with us.                                </p>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>



</template>


<script>
    import courses from "./courses";
    export default {
        components:{
            courses
        },
        data(){
            return{
                descriptionItems:[
                    "We are an online Institute that provides live sessions for All ages, for you (Male or Female) and your Kids.",
                    "Especially our children, where we give them the most attention, because we consider them the bright Future that will carry the Message after us.",
                    "And As we believe that the Quraan and the Islam studies are closely related to each other, So we proudly decided to approach that method \"All in One\", to combine the Quraan, Islam studies and Arabic in one class, to achieve our goal that we are striving for, which is to build a wise Muslim who could be a Model to follow for everyone else and also to show the True image of Islam in its correct form. and reCorrecting the misconceptions and wrong Thoughts that some have.",
                    "And to be able to achieve our Lofty Goal, we decided to choose our team very carefully and accurately to be able to take responsibility.",
                    "Our Team is a highly qualified native Egyptian Arabic speakers and graduated from Al-Azhar University in Egypt, the beacon of Islam all over the world.",
                    "We have our OWN Especial Approaches in Teaching that we learned from our shaikhs in Al-Azhar that consist of active and passive Approaches. and because we care, we ill start with you where your Level is.",
                ]
            }
        },
    }
</script>
<style scoped>
    @import url('https://fonts.googleapis.com/css?family=Special+Elite');
    @import url('https://fonts.googleapis.com/css?family=Forum');

    .title-style{
        font-family: 'Forum', cursive !important;
        font-size: 80px;
    }

    .ol_margin{
        margin: -10px 40px;
    }
    blockquote {
        font-family: 'Special Elite', cursive;
        font-weight: 100;
        font-size: 1.5rem;
        line-height: 1.4;
        position: relative;
        margin: 0;
        padding: .5rem;
    }

    blockquote:before,
    blockquote:after {
        font-family: 'Special Elite', cursive;
        position: absolute;
        color: #009efb !important;
        font-size: 4rem;
        width: 3rem;
        height: 3rem;
    }

    blockquote:before {
        content: '“';
        left: -2rem;
        top: -11px;
    }

    blockquote:after {
        content: '”';
        right: -2rem;
        bottom: 0;
    }
    .text-bold{
        font-weight: bolder;
    }
    .bg-darked{
        background-color:rgba(0, 0, 0, 0.5);
    }
    .fa-bars-staggered:before,.fa-reorder:before,.fa-stream:before{content:"\f550"}

    .feature-icon{
        background-color: transparent !important;
    }
    .feature-icon .circle{
        background-color: transparent !important;
    }
    .feature-box:hover{
        background:
            linear-gradient(to left top, #0d6efd 0%/*bottom-right color*/, #01cae4 50% /*middle color*/, #01cae4 100% /*top-left color*/),
            linear-gradient(#e7f1ff, #e7f1ff)/*"faked" black background make sure to add last or it will appear before the transparent/colored layer*/;
    }
    .feature-box:hover p,
        .feature-box:hover i {
        color: white !important;
    }
</style>

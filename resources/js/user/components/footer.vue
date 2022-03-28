<template>
    <footer class="footer">

        <div class="footer-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">

                        <div class="footer-widget footer-about">
                            <div class="footer-logo">
                                <img src="/assets/img/logo.png" alt="logo">
                            </div>
                            <div class="footer-about-content">
                                <p>
                                    Online Institute provides live classes for All ages,for you and your kids with a highly qualified native tutors from Al-Azhar in Egypt for Quraan and Islam "all in one".
                                </p>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/quraanedu.fb" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/quraan_edu" target="_blank"><i class="fab fa-twitter"></i> </a>
                                        </li>
<!--                                        <li>-->
<!--                                            <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>-->
<!--                                        </li>-->
                                        <li>
                                            <a href="https://wa.me/message/JBQ3GVHCNEQZH1" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/quraanedu.insta/" target="_blank"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6">

                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">Courses</h2>
                            <ul>
                                <li v-for="course in coursesList">
                                    <router-link :to="'/course/'+course.id">
                                        {{ course.title }}
                                    </router-link>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6">

                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">Our Links</h2>
                            <ul>
                                <li>
                                    <a class="cursor-pointer" @click="openChat">
                                        Contact Us
                                    </a>
                                </li>
                                <li>
                                    <router-link to="/aboutUs">
                                        About Us
                                    </router-link>
                                </li>
                                <li>
                                    <router-link to="/terms">
                                        Terms And Conditions
                                    </router-link>
                                </li>
                                <li>
                                    <router-link to="/privacyPolicy">
                                        Privacy Policy
                                    </router-link>
                                </li>
                                <li>
                                    <router-link to="/pricing">
                                        Pricing
                                    </router-link>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6">

                        <div class="footer-widget footer-contact">
                            <h2 class="footer-title">Contact Us</h2>
                            <div class="footer-contact-info">
                                <div class="footer-address">
                                    <span><i class="fas fa-map-marker-alt"></i></span>
                                    <p> Head Office: Cairo, Egypt </p>
                                </div>
                                <p>
                                    <i class="fas fa-phone-alt"></i>
                                    WhatsApp: +201149770796
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-envelope"></i>
                                    <a class="text-primary" href="mailto:info@quraanedu.com">Email: info@quraanedu.com</a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="footer-bottom">
            <div class="container-fluid">

                <div class="copyright">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="copyright-text">
                                <p class="mb-0">&copy; {{ year }} Quraan edu. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </footer>
</template>

<script>
    export default {
        data(){
            return{
                year:"",
                coursesList:[]
            }
        },
        methods:{
            getCurrentYear(){
                let date = new Date();
                this.year  = date.getUTCFullYear();
            },
            getCourses(){
                axios.get("/api/courses")
                    .then((res)=>{
                        this.coursesList = res.data;
                    })
                    .catch((err)=>{
                        // console.log(err);
                    });
            },
            openChat(){
                document.getElementById("webchat_header").click();
            }
        },
        beforeMount() {
            this.getCurrentYear();
            this.getCourses();
        }
    }
</script>


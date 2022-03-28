<template>
    <section class="section mt-2">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="text-primary">About Us</h2>
            </div>

            <div class="row m-auto " style="font-size: 18px !important;">
                <div class="col-12">
                    <p class="sub-title" v-for="item in descriptionItems">
                        {{ item }}
                    </p>
                    <h3 class="text-primary text-center">Vision and mission</h3>
                    <p class="sub-title"> <i class="fas fa-long-arrow-alt-right  text-primary"></i> We aim to spread out the true Islam Identity among all Muslims. </p>
                    <p class="sub-title"> <i class="fas fa-long-arrow-alt-right  text-primary"></i> To understand what Allah wants from us and what Allah wants us to do. </p>
                    <p class="sub-title"> <i class="fas fa-long-arrow-alt-right  text-primary"></i> And particularly what Allah wants us to be, all in one book "the Holy Qur’an". </p>
                    <h3 class="text-primary">Therefore,</h3>
                    <p class="sub-title"> <i class="fas fa-long-arrow-alt-right  text-primary"></i> With all proud we are "Quraan edu"  present you our services. and with what we offer we hope to seek Allah's pleasing.  </p>
                </div>
            </div>

        </div>
    </section>
</template>


<script>
    export default {

        data(){
            return{
                descriptionItems:[
                    "We are an online Institute that provides live sessions for All ages, for you (Male or Female) and your Kids.",
                    "Especially our children, where we give them the most attention, because we consider them the bright Future that will carry the Message after us.",
                    "And As we believe that the Quraan and the Islam studies are closely related to each other, So we proudly decided to approach that method \"All in One\", to combine the Quraan, Islam studies and Arabic in one class, to achieve our goal that we are striving for, which is to build a wise Muslim who could be a Model to follow for everyone else and also to show the True image of Islam in its correct form. and reCorrecting the misconceptions and wrong Thoughts that some have.",
                    "And to be able to achieve our Lofty Goal, we decided to choose our team very carefully and accurately to be able to take responsibility.",
                    "Our Team is a highly qualified native Egyptian Arabic speakers and graduated from Al-Azhar University in Egypt, the beacon of Islam all over the world.",
                    "We have our OWN Especial Approaches in Teaching that we learned from our shaikhs in Al-Azhar that consist of active and passive Approaches. and because we care, we ill start with you where your Level is.",
                    "We are available all time. If you are having a Fatwah or any Islamic question,If you are having any concern about any information in the website or If you are struggling in specific days, Our customer service is available 24 Hours a week and you can get in touch with us through Email or via whats app or through our social media channels.",
                ]
            }
        }
    }
</script>
<style scoped>

</style>

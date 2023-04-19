<template>
    <div class="iframe-container">
        <meta name="format-detection" content="telephone=no">
    </div>
</template>

<script>


    export default {
        name: "zoomRoom",
        props: {
            id: Number
        },
        data(){
            return{
                meetConfig:{
                    apiKey: 'vz6pKGljQHebFfSZxiuyVA',
                    apiSecret: '4F0qhRP3EYS1gCObDWNdJeUlkWMKk7I9OuEd',
                    meetingNumber: this.id,
                    role: 1,
                    leaveUrl: 'http://127.0.0.1:8000/schedule-timings',
                    userName: this.$store.state.currentUser.name,
                    userEmail: this.$store.state.currentUser.email,
                    passWord: '0123456'
                },
                signature: {}

            }
        },
        methods:{
            joinMeeting(){
                var ZoomMtg = require("@zoomus/websdk").ZoomMtg

                ZoomMtg.setZoomJSLib('https://dmogdx0jrul3u.cloudfront.net/2.1.1/lib', '/av');
                ZoomMtg.preLoadWasm();
                ZoomMtg.prepareWebSDK();


                this.signature = ZoomMtg.generateSignature({
                    meetingNumber: this.meetConfig.meetingNumber,
                    apiKey: this.meetConfig.apiKey,
                    apiSecret: this.meetConfig.apiSecret,
                    role: this.meetConfig.role,
                    success: function(res) {

                    }
                });


                ZoomMtg.init({
                    leaveUrl: 'http://127.0.0.1:8000/schedule-timings',
                    isSupportAV: true,
                    success: (success) => {

                        ZoomMtg.join({
                            signature: this.signature,
                            meetingNumber: this.meetConfig.meetingNumber,
                            userName: this.meetConfig.userName,
                            apiKey: this.meetConfig.apiKey,
                            userEmail: this.meetConfig.userEmail,
                            passWord: this.meetConfig.passWord,
                            success: (success) => {
                            },
                            error: (error) => {
                            }
                        })

                    },
                    error: (error) => {
                    }
                })

            }
        },
        beforeMount() {
            this.joinMeeting();
        },
    }
</script>

<style scoped>

</style>

<template>

    <meta http-equiv="origin-trial"
          content="ApbyCprSSGVaT3D3B6PtIv+n/9OBJNNvn90FOjL7bJcSHnPiF3EWtIu0cucMH4cSEaJfG+5/wMev1YBGHQNkHw0AAABLeyJvcmlnaW4iOiJodHRwczovLzAuMC4wLjA6MzAwMCIsImZlYXR1cmUiOiJXZWJDb2RlY3MiLCJleHBpcnkiOjE2MjYyMjA3OTl9"
    >
    <div class="container app-root">
        <!-- Preview view -->
        <div id="js-preview-view" class="container preview__root">
            <span>
                <h1>Join Video Session</h1>
            </span>
            <div class="container video-app">
                <!-- You can use any height or width you wish for the preview -->
                <video id="js-preview-video" class="preview-video" playsinline="" muted="" data-video="0"></video>
                <div class="container meeting-control-layer">
                    <!-- "fas" and "fa" are icon prefixes for the font-awesome library -->
                    <button id="js-preview-mic-button" class="meeting-control-button">
                        <i id="js-preview-mic-icon" class="fas fa-microphone-slash"></i>
                    </button>
                    <button id="js-preview-webcam-button" class="meeting-control-button">
                        <i id="js-preview-webcam-icon" class="fas fa-video webcam__off"></i>
                    </button>
                </div>
            </div>
            <button id="js-preview-join-button" class="join-button">
                Join
            </button>
        </div>
        <!-- Loading view -->
        <div id="js-loading-view" class="container loading-view hidden">
            <h1>Joining session, sit tight...</h1>
            <i class="fas fa-spinner loading-spinner"></i>
        </div>
        <!-- In-session view -->
        <div id="js-video-view" class="container video-app hidden">
            <canvas id="video-canvas" class="video-canvas" width="1280" height="640"></canvas>
            <div class="container meeting-control-layer">
                <!-- "fas" and "fa" are icon prefixes for the font-awesome library -->
                <button id="js-mic-button" class="meeting-control-button">
                    <i id="js-mic-icon" class="fas fa-microphone-slash"></i>
                </button>
                <button id="js-webcam-button" class="meeting-control-button">
                    <i id="js-webcam-icon" class="fas fa-video webcam__off"></i>
                </button>
                <div class="vertical-divider"></div>
                <button id="js-leave-button"
                        class="meeting-control-button meeting-control-button__leave-session">
                    <i id="js-leave-session-icon" class="fas fa-phone"></i>
                </button>
            </div>
        </div>
        <!-- Ending view -->
        <div id="js-end-view" class="container ending-view hidden">
            <h1>You have successfully left the session!</h1>
        </div>
    </div>

</template>

<script>

    // import ZoomVideo from '@zoom/videosdk';
    // const client = ZoomVideo.createClient();

    export default {
        name: "zoomFrame2",
        data(){
            return{
                meetConfig:{
                    apiKey: 'vz6pKGljQHebFfSZxiuyVA',
                    apiSecret: '4F0qhRP3EYS1gCObDWNdJeUlkWMKk7I9OuEd',
                    meetingNumber: "89748372995",
                    role: 1,
                    leaveUrl: 'http://127.0.0.1:8000/schedule-timings',
                    userName: this.$store.state.currentUser.name,
                    userEmail: this.$store.state.currentUser.email,
                    passWord: '0123456'
                },
            }
        },
        methods:{

        },
        beforeMount() {

        }
    }
</script>

<style scoped>

</style>

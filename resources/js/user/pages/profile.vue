<template>
    <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <profileSidebar></profileSidebar>

                    <router-view></router-view>
                </div>
            </div>
        </div>
</template>

<script>
    import profileSidebar from "../components/profileSidebar";
    export default {
        components:{
            profileSidebar
        }
    }
</script>

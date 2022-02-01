<template>

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">

            </div>
        </div>
    </div>

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

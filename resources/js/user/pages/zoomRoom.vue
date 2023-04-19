<template>

    <div class="meeting">

        <a href="/">
            <img src="/assets/img/logo.png" class="img-fluid" alt="Logo">
        </a>

        <div class="container-zoom">
            <zoomFrame :id="$route.params.id"></zoomFrame>
        </div>
    </div>

</template>

<script>
    import zoomFrame from "../components/zoomFrame";
    export default {
        name: "zoomRoom",
        components:{
            zoomFrame,
        }
    }
</script>

<style scoped>
    .container-zoom {
        width: 70%;
        height: 100%;
    }
</style>

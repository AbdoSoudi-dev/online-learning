<template>

    <div class="main-wrapper">

        <header-component></header-component>

            <router-view></router-view>

<!--        <home-component></home-component>-->

        <footer-component></footer-component>

    </div>
</template>


<script>
    import header from "../components/header"
    import footer from "../components/footer"
    import home from "./home"
    export default {
        components:{
            "headerComponent":header,
            "footerComponent":footer,
            "homeComponent":home,
        }
    }
</script>

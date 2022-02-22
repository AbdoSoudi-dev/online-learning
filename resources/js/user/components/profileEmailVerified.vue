<template>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="content success-page-cont" style="min-height: 509px;">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card success-card">
                        <div class="card-body">
                            <div class="success-cont">
                                <i class="fas fa-check"></i>
                                <h3>Your email has been verified successfully!</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "profileEmailVerified",
        mounted() {
            setTimeout(()=>{
                this.$router.push("/profile")
            },20000)
        }
    }
</script>

<style scoped>

</style>

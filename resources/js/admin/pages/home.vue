<template>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title text-capitalize">Welcome {{ $store.state.currentUser.name }} !</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Admin Panel</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

    }
</script>

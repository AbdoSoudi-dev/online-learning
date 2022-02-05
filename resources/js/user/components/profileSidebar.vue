<template>
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

            <div class="profile-sidebar">
                <div class="user-widget">
                    <div class="pro-avatar text-uppercase">
                        {{
                            $store.state.currentUser.name.split("")[0] +
                            ($store.state.currentUser.name.split(" ")[1] ?
                                    $store.state.currentUser.name.split(" ")[1].split("")[0] : $store.state.currentUser.name.split("")[1] )
                        }}
                    </div>
                    <div class="user-info-cont">
                        <h4 class="usr-name text-capitalize">{{ $store.state.currentUser.name }}</h4>
<!--                        <p class="mentor-type">English Literature (M.A)</p>-->
                    </div>
                </div>
                <div class="progress-bar-custom text-danger">
                    <h6>Verify Your Account </h6>
                </div>
                <div class="custom-sidebar-nav">
                    <ul>
                        <li>
                            <router-link to="/bookings">
                                <i class="fas fa-clock"></i>Bookings <span><i class="fas fa-chevron-right"></i></span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/schedule-timings">
                                <i class="fas fa-hourglass-start"></i>Schedule Timings <span><i class="fas fa-chevron-right"></i></span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/invoices">
                                <i class="fas fa-file-invoice"></i>My Invoices <span><i class="fas fa-chevron-right"></i></span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/reviews">
                                <i class="fas fa-eye"></i>My Reviews <span><i class="fas fa-chevron-right"></i></span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/profile">
                                <i class="fas fa-user-cog"></i>Edit Profile <span><i class="fas fa-chevron-right"></i></span>
                            </router-link>
                        </li>
                        <li>
                            <a>
                                <i class="fas fa-sign-out-alt"></i>Logout <span><i class="fas fa-chevron-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
</template>

<script>
    export default {

    }
</script>

<template>
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

            <div class="profile-sidebar">
                <div class="user-widget">
                    <div class="pro-avatar">JD</div>
                    <div class="rating">
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="user-info-cont">
                        <h4 class="usr-name">Jonathan Doe</h4>
                        <p class="mentor-type">English Literature (M.A)</p>
                    </div>
                </div>
                <div class="progress-bar-custom">
                    <h6>Complete your profiles ></h6>
                    <div class="pro-progress">
                        <div class="tooltip-toggle" tabindex="0"></div>
                        <div class="tooltip">80%</div>
                    </div>
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

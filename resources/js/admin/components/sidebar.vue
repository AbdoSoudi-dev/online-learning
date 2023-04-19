<template>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span><i class="fe fe-home"></i> Main</span>
                    </li>
                    <li class="active">
                        <a><router-link to="/admin"><span>Dashboard</span></router-link></a>
                    </li>
                    <li>
                        <a><router-link to="/admin/courses"><span>Courses</span></router-link></a>
                    </li>
                    <li v-if="$store.state.currentUser.role_id == 3">
                        <a><router-link to="/admin/users"><span>Users</span></router-link></a>
                    </li>
                    <li>
                        <a><router-link to="/admin/bookings"><span>Booking List</span></router-link></a>
                    </li>
                    <li>
                        <a><router-link to="/admin/invoices">Invoice Reports</router-link></a>
                    </li>
                    <li>
                        <a><router-link to="/admin/timings"><span>Timings</span></router-link></a>
                    </li>
                    <li>
                        <a><router-link to="/admin/meetings"><span>Meetings</span></router-link></a>
                    </li>
                    <li>
                        <a><router-link to="/admin/new_meeting"><span>New Meeting</span></router-link></a>
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

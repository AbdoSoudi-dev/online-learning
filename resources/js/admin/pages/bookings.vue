<template>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Bookings</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><router-link to="/admin">Dashboard</router-link></li>
                            <li class="breadcrumb-item active">Bookings</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                        <th>Mentor Name</th>
                                        <th>Course</th>
                                        <th>Mentee Name</th>
                                        <th>Booking Time</th>
                                        <th>Status</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-08.jpg" alt="User Image"></a>
                                                <a>James Amen</a>
                                            </h2>
                                        </td>
                                        <td>Maths</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user.jpg" alt="User Image"></a>
                                                <a>Jonathan Doe </a>
                                            </h2>
                                        </td>
                                        <td>9 Nov 2019 <span class="text-primary d-block">11.00 AM - 11.15 AM</span></td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status_1" class="check" checked>
                                                <label for="status_1" class="checktoggle">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            $200.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-07.jpg" alt="User Image"></a>
                                                <a>Jessica Fogarty</a>
                                            </h2>
                                        </td>
                                        <td>Business Maths</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user1.jpg" alt="User Image"></a>
                                                <a>Julie Pennington </a>
                                            </h2>
                                        </td>
                                        <td>5 Nov 2019 <span class="text-primary d-block">11.00 AM - 11.35 AM</span></td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status_2" class="check" checked>
                                                <label for="status_2" class="checktoggle">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            $300.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-17.jpg" alt="User Image"></a>
                                                <a>Jose Anderson</a>
                                            </h2>
                                        </td>
                                        <td>Algebra</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user2.jpg" alt="User Image"></a>
                                                <a>Tyrone Roberts</a>
                                            </h2>
                                        </td>
                                        <td>11 Nov 2019 <span class="text-primary d-block">12.00 PM - 12.15 PM</span></td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status_3" class="check" checked>
                                                <label for="status_3" class="checktoggle">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            $150.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-06.jpg" alt="User Image"></a>
                                                <a>Sofia Brient</a>
                                            </h2>
                                        </td>
                                        <td>Integrated Sum</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user3.jpg" alt="User Image"></a>
                                                <a>Allen Davis </a>
                                            </h2>
                                        </td>
                                        <td>7 Nov 2019<span class="text-primary d-block">1.00 PM - 1.20 PM</span></td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status_4" class="check" checked>
                                                <label for="status_4" class="checktoggle">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            $150.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-14.jpg" alt="User Image"></a>
                                                <a>Marvin Campbell</a>
                                            </h2>
                                        </td>
                                        <td>Flow chart</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="assets/img/user/user4.jpg" alt="User Image"></a>
                                                <a>Patricia Manzi </a>
                                            </h2>
                                        </td>
                                        <td>15 Nov 2019 <span class="text-primary d-block">1.00 PM - 1.15 PM</span></td>
                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status_5" class="check" checked>
                                                <label for="status_5" class="checktoggle">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            $200.00
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
        name: "bookings"
    }
</script>

<style scoped>

</style>

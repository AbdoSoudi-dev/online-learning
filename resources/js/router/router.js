import { createRouter, createWebHistory } from "vue-router";
import store from "../store/vuex";


import index from "../user/pages/index"
import home from "../user/pages/home";
import login from "../user/pages/login";
import register from "../user/pages/register";
import courses from "../user/pages/courses";
import profile from "../user/pages/profile";
import bookingProfile from "../user/components/bookingProfile";
import profileScheduleTimings from "../user/components/profileScheduleTimings";
import profileInvoices from "../user/components/profileInvoices";
import profileEdit from "../user/components/profileEdit";
import profileReviews from "../user/components/profileReviews";
import indexAdmin from "../admin/pages/index"
import homeAdmin from "../admin/pages/home"
import adminCourses from "../admin/pages/courses"
import adminBookings from "../admin/pages/bookings"
import adminInvoices from "../admin/pages/invoices"
import adminUsers from "../admin/pages/users"
import adminProfile from "../admin/pages/profile"
import addUser from "../admin/pages/addUser";
import addCourse from "../admin/pages/addCourse";
import courseDetails from "../user/pages/courseDetails";
import timings from "../admin/pages/timings";
import enrollCourse from "../user/pages/enrollCourse";
import createMeetings from "../admin/pages/createMeetings";
import meetings from "../admin/pages/meetings";
import zoomRoom from "../user/pages/zoomRoom";
import payment from "../user/pages/payment";


const routes = [
    { path : "/joinRoom", component: zoomRoom },
    { path: "/", name:"home", component: index,
        children:[
            { path : "/home", component: home,alias:"/" },
            { path : "/coursesList", component: courses },
            { path : "/course/:id", component: courseDetails },
            { path : "/enrollCourse/:id", component: enrollCourse },
            { path : "/payment/:booking_id", component: payment },
            { path: "/login", name:"user.login" , component: login,meta: { requiresNoAuth: true },  },
            { path: "/register", name:"user.register" , component: register,meta: { requiresNoAuth: true },  },
            { path : "/profile", component: profile, meta: { requiresAuth: true },
                children:[
                    { path: "/bookings",component:bookingProfile },
                    { path: "/schedule-timings",component:profileScheduleTimings },
                    { path: "/invoices",component:profileInvoices },
                    { path: "/reviews",component:profileReviews },
                    { path: "",component:profileEdit },
                ]
            },
        ]
    },
    { path: '/admin', component: indexAdmin,
        meta: { requiresAdmin: true },
        children: [
            { path: "dashboard", component: homeAdmin,alias:"/admin"  },
            { path: "courses", component: adminCourses  },
            { path: "bookings",component: adminBookings  },
            { path: "invoices",component: adminInvoices  },
            { path: "users", component: adminUsers, meta: { requiresSuperadmin: true },  },
            { path: "addUser", component: addUser, meta: { requiresSuperadmin: true },  },
            { path: "profile", component: adminProfile  },
            { path: "addCourse", component: addCourse  },
            { path: "timings", component: timings  },
            { path: "new_meeting", component: createMeetings  },
            { path: "meetings", component: meetings  },

        ]
    },
];

const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {

    let requiresAdminCond = to.matched.some(record => record.meta.requiresAdmin) && store.state.token !== "" && to.meta.requiresAdmin
        && (!store.state.currentUser.role_id || store.state.currentUser.role_id == 1 );

    let requiresSuperadminCond = to.matched.some(record => record.meta.requiresSuperadmin) && store.state.token !== ""
        && to.meta.requiresSuperadmin && (!store.state.currentUser.role_id || store.state.currentUser.role_id != 3 );

    let requiresAuth = to.matched.some(record => record.meta.requiresAuth) && !store.state.token && to.meta.requiresAuth
        && !store.state.currentUser.role_id;

    let requiresNoAuth = to.matched.some(record => record.meta.requiresNoAuth) && store.state.token && to.meta.requiresNoAuth
        && store.state.currentUser.role_id;



    if ( requiresAdminCond || requiresSuperadminCond || requiresNoAuth || requiresAuth) {
        next("/")
    }
    else{
        next();
    }


})

export default router;

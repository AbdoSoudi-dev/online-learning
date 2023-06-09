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
import profileChangePassword from "../user/components/profileChangePassword";
import emailVerification from "../user/pages/emailVerification";
import profileEmailVerified from "../user/components/profileEmailVerified";
import aboutUs from "../user/pages/aboutUs";
import resetPassword from "../user/pages/resetPassword";
import newPassword from "../user/pages/newPassword";
import editUser from "../admin/pages/editUser";
import editCourse from "../admin/pages/editCourse";
import pricing from "../user/pages/pricing";
import privacyPolicy from "../user/pages/privacyPolicy";
import terms from "../user/pages/terms";


const routes = [
    { path : "/join_room/:id", component: zoomRoom },
    { path: "/", name:"home", component: index,
        children:[
            { path : "/home", component: home,alias:"/" },
            { path : "/aboutus", component: aboutUs },
            { path : "/privacy_policy", component: privacyPolicy },
            { path : "/terms", component: terms },
            { path : "/courses_list", component: courses },
            { path : "/pricing", component: pricing },
            { path : "/course/:id", component: courseDetails },
            { path : "/enroll_course/:id", component: enrollCourse,meta: { requiresAuth: true } },
            { path : "/payment/:booking_id", component: payment },
            { path: "/login", name:"user.login" , component: login,meta: { requiresNoAuth: true },  },
            { path: "/register", name:"user.register" , component: register,meta: { requiresNoAuth: true },  },
            { path: "/reset_password" , component: resetPassword,meta: { requiresNoAuth: true },  },
            { path: "/new_password" , component: newPassword,meta: { requiresNoAuth: true },  },
            { path : "/profile", component: profile, meta: { requiresAuth: true },
                children:[
                    { path: "/bookings",component:bookingProfile },
                    { path: "/schedule_timings",component:profileScheduleTimings },
                    { path: "/invoices",component:profileInvoices },
                    { path: "/reviews",component:profileReviews },
                    { path: "/change_password",component:profileChangePassword },
                    { path: "/email_verification",component:emailVerification },
                    { path: "/email_verified",component:profileEmailVerified },
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
            { path: "add_user", component: addUser, meta: { requiresSuperadmin: true },  },
            { path: "edit_user/:id", component: editUser, meta: { requiresSuperadmin: true },  },
            { path: "add_course", component: addCourse  },
            { path: "edit_course/:id", component: editCourse  },
            { path: "timings", component: timings  },
            { path: "new_meeting", component: createMeetings  },
            { path: "meetings", component: meetings  },

        ]
    },
    { path: '/:pathMatch(.*)*', component: index },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {

    let requiresAdminCond = to.matched.some(record => record.meta.requiresAdmin) && to.meta.requiresAdmin
        && (!store.state.currentUser.role_id || store.state.currentUser.role_id == 1 );

    let requiresSuperadminCond = to.matched.some(record => record.meta.requiresSuperadmin)
        && to.meta.requiresSuperadmin && (!store.state.currentUser.role_id || store.state.currentUser.role_id != 3 );

    let requiresAuth = to.matched.some(record => record.meta.requiresAuth) && !store.state.token && to.meta.requiresAuth
        && !store.state.currentUser.role_id;

    let requiresNoAuth = to.matched.some(record => record.meta.requiresNoAuth) && store.state.token && to.meta.requiresNoAuth
        && store.state.currentUser.role_id;


    if ( requiresAdminCond || requiresSuperadminCond) {
        location.href = "/";
    }else if (requiresNoAuth || requiresAuth){
        next("/")
    }
    else{
        next();
    }


})

export default router;

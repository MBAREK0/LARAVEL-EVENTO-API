import { createRouter, createWebHistory } from 'vue-router'
import home from '@/components/user/home.vue'
import organizer from '@/components/organizer/organizerDashbord.vue'
import admin from '@/components/admin/adminDashbord.vue'
import event from '@/components/user/event.vue'
import signin from '@/components/user/auth/sign-in.vue'
import signup from '@/components/user/auth/sign-up.vue'
import logout from '@/components/user/auth/logout.vue'
import resetPassword from '@/components/user/auth/resetPassword.vue'
import forgetPassword from '@/components/user/auth/forgetPassword.vue'
import notFound from '@/components/404.vue'
import editEvent from '@/components/organizer/event-form.vue'


const routes = [
  {
    path: '/',
    component: home,
    name: 'home'
  },
  {
    path: '/event',
    component: event,
    name: 'event'
  },
  {
    path: '/organizer',
    component: organizer,
    name: 'organizer',
    meta: { requiresRole: '2' }
  },
  {
    path: '/editEvent',
    component: editEvent,
    name: 'editEvent',
    meta: { requiresRole: '2' }
  },
  {
    path: '/admin',
    component: admin,
    name: 'admin',
    meta: { requiresRole: '3' }
  },
  {
    path: '/sign-in',
    component: signin,
    name: 'sign-in'
  },
  {
    path: '/sign-up',
    component: signup,
    name: 'sign-up'
  },
  {
    path: '/logout',
    component: logout,
    name: 'logout'
  },
  {
    path: '/forget-password',
    component: forgetPassword,
    name: 'forget-password' 

  },
  {
    path: '/resetPassword',
    component: resetPassword,
    name: 'fresetPassword'

  },
  {
    // Catch-all route for 404 errors
    path: '/:catchAll(.*)',
    component: notFound
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  const requiresRole = to.meta.requiresRole;
  const userRole = localStorage.getItem('role');

  if (userRole === '3') next();
  else{
    if (requiresRole && userRole !== requiresRole) {
      next({ name: 'home' });
    } else {
      next();
    }
  }
});


export default router

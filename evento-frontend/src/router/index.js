import { createRouter, createWebHistory } from 'vue-router'
import home from '@/components/user/home.vue'
import organizer from '@/components/organizer/organizerDashbord.vue'
import admin from '@/components/admin/adminDashbord.vue'
import event from '@/components/user/event.vue'
import signin from '@/components/user/sign-in.vue'
import signup from '@/components/user/sign-up.vue'
import logout from '@/components/user/logout.vue'
import notFound from '@/components/404.vue'

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

  if (userRole == '3') next();
  if (requiresRole && userRole !== requiresRole) {
    next({ name: 'home' });
  } else {
    next();
  }
});


export default router

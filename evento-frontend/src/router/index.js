import { createRouter, createWebHistory } from 'vue-router'
import home from '@/components/user/home.vue'
import organizer from '@/components/organizer/organizerDashbord.vue'
import admin from '@/components/admin/adminDashbord.vue'
import event from '@/components/user/event.vue'
import signin from '@/components/user/sign-in.vue'
import signup from '@/components/user/sign-up.vue'
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
    name: 'organizer'
  },
  {
    path: '/admin',
    component: admin,
    name: 'admin'
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
    // Catch-all route for 404 errors
    path: '/:catchAll(.*)',
    component: notFound
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

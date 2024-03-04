import { createRouter, createWebHistory } from 'vue-router'
import home from '@/components/user/home.vue'
import makeEvents from '@/components/user/makeEvents.vue'
import event from '@/components/user/event.vue'
import signin from '@/components/user/sign-in.vue'
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
    path: '/makeEvents',
    component: makeEvents,
    name: 'makeEvents'
  },
  {
    path: '/sign-in',
    component: signin,
    name: 'sign-in'
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

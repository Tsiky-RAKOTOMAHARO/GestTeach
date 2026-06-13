import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import ListView from '../views/ListView.vue'
import CreateView from '../views/CreateView.vue'
import StatView from '../views/StatView.vue'
import AppShell from '@/layouts/AppShell.vue'

const routes = [
  {
    path: '/login',
    component: LoginView
  },
  {
    path: '/',
    component: AppShell,
    meta: { requiresAuth: true },
    children: [
      { path: 'list', component: ListView },
      { path: 'create', component: CreateView },
      { path: 'stats', component: StatView },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to) => {
  const isAuthenticated = localStorage.getItem('isLoggedIn')
  if (to.matched.some(r => r.meta.requiresAuth) && !isAuthenticated) {
    return '/login'
  }
})

export default router
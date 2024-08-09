import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import VerifyView from '@/views/VerifyView.vue'
import { useUserStore } from '@/stores/Auth'
import AllTopicsView from '@/views/AllTopicsView.vue'
import DetailsTopicView from '@/views/DetailsTopicView.vue'
import DashboardView from '@/views/DashboardView.vue'
import UserProfileView from '@/views/UserProfileView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },

    {
      path: '/verify',
      name: 'verify',
      component: VerifyView
    },
    {
      path: '/topics',
      name: 'topics',
      component: AllTopicsView
    },
    {
      path: '/topics/:id',
      name: 'topic',
      component: DetailsTopicView
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: DashboardView
    },
    {
      path: '/users/:id',
      name: 'profile',
      component: UserProfileView
    }
  ]
})

router.beforeEach(async (to, from) => {
  const userStore = useUserStore()

  if (localStorage.getItem('token') && to.name == 'login') {
    return { name: 'home' }
  }

  if (localStorage.getItem('token') && to.name == 'register') {
    return { name: 'home' }
  }
  let userId = localStorage.getItem('jsskshshddyeegshs')
  if ((userId != 11 || userId == null) && to.name == 'dashboard') {
    return { name: 'home' }
  }
  // if (userId != 11 && to.name='dashbord') {
  //   return { name: 'home' }
  // }
  // if (!userStore.user.isAdmin) {
  //   return { name: 'home' }
  // }

  // if (from('http://localhost:8000')){
  //   userStore.validateEmail()
  // }

  // if (!userStore.user && to.meta.auth) {
  //   return { name: 'login' }
  // }
})

export default router

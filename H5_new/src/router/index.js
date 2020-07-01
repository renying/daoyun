import Vue from 'vue'
import Router from 'vue-router'
import Log from '@/components/Login/Log'
import Homepage from '@/components/Homepage'
import RecoverPassword from '@/components/RecoverPassword/RecoverPassword'
import MyInfo from '@/components/MyInfo/MyInfo'
import Register from '@/components/Register/Register'
import Notice from '@/components/Notice/Notice'
import ClassInfo from '@/components/ClassInfo/ClassInfo'

Vue.use(Router)

export default new Router({
  mode: 'hash',
  routes: [
    {
      path: '/',
      name: 'Log',
      component: Log
    },
    {
      path: '/Register',
      name: 'Register',
      component: Register
    },
    {
      path: '/Notice',
      name: 'Notice',
      component: Notice
    },
    {
      path: '/RecoverPassword',
      name: 'RecoverPassword',
      component: RecoverPassword
    },
    {
      path: '/Homepage',
      name: 'Homepage',
      component: Homepage
    },
    {
      path: '/MyInfo/MyInfo',
      name: 'MyInfo',
      component: MyInfo
    },
    {
      path: '/ClassInfo',
      name: 'ClassInfo',
      component: ClassInfo
    }
  ]
})

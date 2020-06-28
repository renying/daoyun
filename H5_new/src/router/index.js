import Vue from 'vue'
import Router from 'vue-router'
import Log from '@/components/Login/Log'
import Homepage from '@/components/Homepage'
import Mycreation from '@/components/Manager/Class/Mycreation'
import Myjoin from '@/components/Manager/Class/Myjoin'
import Drug from '@/components/Manager/Drug/Drug'
import Patient from '@/components/Manager/Patient/Patient'
import PLogin from '@/components/Login/PLogin'
import User from '@/components/User/User'
import UserInfo from '@/components/User/UserInfo'
import Queue from '@/components/uSER/Queue'
import Doctor from '@/components/uSER/Doctor'
import Pifu from '@/components/uSER/Pifu'
import Ear from '@/components/uSER/Ear'
import Child from '@/components/uSER/Child'
import Cure from '@/components/Cure/Cure'
import Input from '@/components/Cure/Input'
import Advice from '@/components/Cure/Advice'
import RecoverPassword from '@/components/User/RecoverPassword'
import MyInfo from '@/components/MyInfo/MyInfo'
import Register from '@/components/Register/Register'
import Notice from '@/components/Notice/Notice'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Log',
      component: Log
    },
    {
      path: '/PLogin',
      name: 'PLogin',
      component: PLogin
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
      path: '/User',
      name: 'User',
      component: User,
      children: [
        {
          path: '/User/UserInfo',
          name: 'UserInfo',
          component: UserInfo
        },
        {
          path: '/User/RecoverPassword',
          name: 'RecoverPassword',
          component: RecoverPassword
        },
        {
          path: '/Visitor/Queue',
          name: 'Queue',
          component: Queue
        },
        {
          path: '/Visitor/Doctor',
          name: 'Doctor',
          component: Doctor
        },
        {
          path: '/Visitor/Pifu',
          name: 'Pifu',
          component: Pifu
        },
        {
          path: '/Visitor/Ear',
          name: 'Ear',
          component: Ear
        },
        {
          path: '/Visitor/Child',
          name: 'Child',
          component: Child
        }
      ]
    },
    {
      path: '/Homepage',
      name: 'Homepage',
      component: Homepage,
      children: [
        {
          path: '/Homepage/Mycreation',
          name: 'Mycreation',
          component: Mycreation
        },
        {
          path: '/Homepage/Myjoin',
          name: 'Myjoin',
          component: Myjoin
        },
        {
          path: '/HospitalManager/Drug',
          name: 'Drug',
          component: Drug
        },
        {
          path: '/HospitalManager/Patient',
          name: 'Patient',
          component: Patient
        }
      ]
    },
    {
      path: '/Cure/Input',
      name: 'Input',
      component: Input
    },
    {
      path: '/Cure/Cure',
      name: 'Cure',
      component: Cure,
      children: [
        {
          path: '/Cure/Advice',
          name: 'Advice',
          component: Advice
        }
      ]
    },
    {
      path: '/MyInfo/MyInfo',
      name: 'MyInfo',
      component: MyInfo
    }
  ]
})

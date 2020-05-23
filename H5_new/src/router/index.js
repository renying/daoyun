import Vue from 'vue'
import Router from 'vue-router'
import Log from '@/components/Login/Log'
import Homepage from '@/components/Homepage'
import Mycreation from '@/components/Manager/Class/Mycreation'
import Myjoin from '@/components/Manager/Class/Myjoin'
import Drug from '@/components/Manager/Drug/Drug'
import Patient from '@/components/Manager/Patient/Patient'
import PLogin from '@/components/Login/PLogin'
import Visitor from '@/components/Visitor'
import Initial from '@/components/Visitor/Initial'
import Setting from '@/components/Visitor/Setting'
import Queue from '@/components/Visitor/Queue'
import Doctor from '@/components/Visitor/Doctor'
import Pifu from '@/components/Visitor/Pifu'
import Ear from '@/components/Visitor/Ear'
import Child from '@/components/Visitor/Child'
import Cure from '@/components/Cure/Cure'
import Input from '@/components/Cure/Input'
import Advice from '@/components/Cure/Advice'
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
      path: '/Visitor',
      name: 'Visitor',
      component: Visitor,
      children: [
        {
          path: '/Visitor/Initial',
          name: 'Initial',
          component: Initial
        },
        {
          path: '/Visitor/Setting',
          name: 'Setting',
          component: Setting
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
    }
  ]
})
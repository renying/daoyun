import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/components/HomePage'
import Login from '@/components/Login/Login'
import List from '@/components/List/List'
import Edit from '@/components/Edit/Edit'
import Recoverpw from '@/components/Recoverpw/Recoverpw'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/HomePage',
      name: 'HomePage',
      component: HomePage,
      children: [
        {
          path: '/List',
          name: 'List',
          component: List
        },
        {
          path: '/Edit',
          name: 'Edit',
          component: Edit
        },
        {
          path: '/Recoverpw',
          name: 'Recoverpw',
          component: Recoverpw
        }
      ]
    },
    {
      path: '/',
      name: 'Login',
      component: Login
    }
  ]
})

import Vue from 'vue'
import Router from 'vue-router'
import login from '@/components/login'
import home from '../components/home/home.vue'
import type_msg from '../components/type_msg.vue'
import all_goodss from '../components/allGoods/all_goodss.vue'
import add_goods from '../components/addGoods/add_goods.vue'
import home_wind from '../components/homeGoods/home_wind.vue'
import homele_goods from '../components/homeGoods/homele_goods.vue'

import homele from '../components/homEle/homele_goods.vue'
import computer from '../components/computer/computer_goods.vue'
import phone from '../components/phone/phone_goods.vue'
import boy from '../components/boy/boy_goods.vue'
import girl from '../components/girl/girl_goods.vue'
import user_msg from '../components/user/user_msg.vue'
import user_orde from '../components/user/user_orde.vue'
import user_address from '../components/user/user_address.vue'
import admin_msg from '../components/admin/admin_msg.vue'
import add_admin from '../components/admin/add_admin.vue'

Vue.use(Router)

export default new Router({
  mode:'history',
  routes: [
    {
      path: '/',
      name: 'login',
      component: login
    },
    {
      path: '/home',
      name: 'home',
      component: home,
      children:[
        {
          path:'/home/type_msg',
          name:'type_msg',
          component:type_msg
        },
        {
          path:'/home/all_goodss',
          name:'all_goodss',
          component:all_goodss
        },
        {
          path:'/home/add_goods',
          name:'add_goods',
          component:add_goods
        },
        {
          path:'/home/home_wind',
          name:'home_wind',
          component:home_wind
        },
        {
          path:'/home/homele_goods',
          name:'homele_goods',
          component:homele_goods
        },
        {
          path:'/home/homele',
          name:'homele',
          component:homele
        },
        {
          path:'/home/computer',
          name:'computer',
          component:computer
        },
        {
          path:'/home/phone',
          name:'phone',
          component:phone
        },
        {
          path:'/home/boy',
          name:'boy',
          component:boy
        },
        {
          path:'/home/girl',
          name:'girl',
          component:girl
        },
        {
          path:'/home/user_msg',
          name:'user_msg',
          component:user_msg
        },
        {
          path:'/home/user_orde',
          name:'user_orde',
          component:user_orde
        },
        {
          path:'/home/user_address',
          name:'user_address',
          component:user_address
        },
        {
          path:'/home/admin_msg',
          name:'admin_msg',
          component:admin_msg
        },
        {
          path:'/home/add_admin',
          name:'add_admin',
          component:add_admin
        }
      ]
    },
  ]
})


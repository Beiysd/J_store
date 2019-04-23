import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import homeEle from '../components/homeEle/homeele'
import Computer from '../components/Computer/computer'
import Boy from '../components/Boy/boy'
import Girl from '../components/Girl/girl'
import Phone from '../components/Phone/phone'
import PhoneApp from '../components/PhoneApp/phoneapp'
import shopCar from '../components/shopCar/shopCar'
import address from '../components/shopCar/address'
import order from '../components/shopCar/order'
import Reg from '../components/LandReg/Reg'
import Land from '../components/LandReg/Land'
import Detail from '../components/Detail/detail'
import search from '../components/search/search'
import test from '../components/test'
Vue.use(Router)

export default new Router({
  linkExactActiveClass:'active',
  mode:'history',
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  },  
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    
    {
      path:'/search',
      name:'search',
      component:search
    },
    {
      path: '/homeele',
      name: 'homeEle',
      component: homeEle
    },
    {
      path: '/computer',
      name: 'Computer',
      component: Computer
    },
    {
      path: '/boy',
      name: 'Boy',
      component: Boy
    },
    {
      path: '/girl',
      name: 'Girl',
      component: Girl
    },
    {
      path: '/phone',
      name: 'Phone',
      component: Phone
    },
    {
      path: '/phoneapp',
      name: 'PhoneApp',
      component: PhoneApp
    },
    {
      path: '/shopcar',
      name: 'shopCar',
      component: shopCar
    },
    {
      path:'/order',
      name:'order',
      component:order
    },
    {
      path:'/address',
      name:'address',
      component:address
    },
    {
      path: '/reg',
      name: 'Reg',
      component: Reg
    },
    {
      path: '/land',
      name: 'Land',
      component: Land
    },
    {
      path:'/detail',
      name:'Detail',
      component:Detail
    },
    {
      path: '/test',
      name: 'test',
      component: test
    }
  ]
})

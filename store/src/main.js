// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import $ from 'jquery'
import Vuex from 'vuex'
// import axios from 'axios'
import axios from '../node_modules/axios'
import PicZoom from 'vue-piczoom'
import './assets/ssass/_index.scss'
import Swiper from 'swiper'
import 'swiper/dist/css/swiper.min.css'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import VueResource from 'vue-resource'
import qs from 'qs'

Vue.config.productionTip = false
Vue.use(Vuex)
Vue.use(ElementUI)
Vue.use(VueResource)
Vue.prototype.$qs = qs;


Vue.prototype.axios = axios
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  $,
  Swiper,
  axios,
  components: { App },
  template: '<App/>',
  PicZoom
})


// router.beforeEach((to, from, next) => {
//   if (to.meta.title) {
//     document.title = to.meta.title
//   }
//   const type = to.meta.type
//   // 判断该路由是否需要登录权限
//   if (type === 'login') {
//     if (window.localStorage.getItem('login')) {
//       next()
//     } else {
//       next('/land')
//     }
//   } else {
//     next()  // 确保一定要有next()被调用
//   }
// })
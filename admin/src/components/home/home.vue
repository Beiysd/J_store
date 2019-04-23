<template>
  <div class="home_body">
    <div class="home_title">后台管理界面</div>
    <div class="userName">
      <span>{{routeName}}</span>
      <h3>欢迎 <i>{{usernames}}</i></h3>
      <a href="#" @click="quit">注销登录</a>
    </div>
<!-- 面包屑导航 -->
    <div class="nav">
      <el-col :span="12">
          <el-menu
              default-active="2"
              class="el-menu-vertical-demo"
              @open="handleOpen"
              @close="handleClose"
              background-color="rgb(84, 92, 100)"
              text-color="#fff"
              active-text-color="#ffd04b">
              <el-menu-item index="home" @click="home">
                <span slot="title">首页</span>
              </el-menu-item>
              <el-submenu index="home">
                  <template slot="title">
                  <span>全部商品管理</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/all_goodss" @click="all_goodss">商品管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="home_goods">
                  <template slot="title">
                  <span>主页商品管理</span>
                  </template>
                  <el-menu-item-group>
                  <!-- <el-menu-item index="home/home_wind" @click="home_wind">风琴图管理</el-menu-item> -->
                  <el-menu-item index="home/homele_goods" @click="homele_goods">家电商品管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="homele">
                  <template slot="title">
                  <span>家电馆商品管理</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/homele" @click="homele">家电商品管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="computer">
                  <template slot="title">
                  <span>电脑馆商品管理</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/computer" @click="computer">电脑商品管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="phone">
                  <template slot="title">
                  <span>3C数码馆商品管理</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/phone" @click="phone">3C数码商品管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="boy">
                  <template slot="title">
                  <span>男装馆商品管理</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/boy" @click="boy">男装商品管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="girl">
                  <template slot="title">
                  <span>女装馆商品管理</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/girl" @click="girl">女装商品管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="user">
                  <template slot="title">
                  <span>用户管理</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/user_msg" @click="user_msg">用户信息管理</el-menu-item>
                   <!-- <el-menu-item index="home/user_shop" @click="user_shop">用户购物车管理</el-menu-item> -->
                  <el-menu-item index="home/user_orde" @click="user_orde">用户订单管理</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
              <el-submenu index="admin">
                  <template slot="title">
                  <span>管理员设置</span>
                  </template>
                  <el-menu-item-group>
                  <el-menu-item index="home/admin_msg" @click="admin">管理员</el-menu-item>
                  </el-menu-item-group>
              </el-submenu>
          </el-menu>
      </el-col>
    </div>
    <div class="msg">
        <router-view></router-view>
    </div>
  </div>

</template>

<script>
import {setCookie,getCookie,delCookie} from '../../assets/js/cookie.js'
export default {
  props:['names'],
  data() {
    return {
      name:'home',
      routeName:'',
      usernames:''
    }
  },
  mounted(){
    this.$nextTick(() => {
      /*页面挂载获取保存的cookie值，渲染到页面上*/
            let uname = getCookie('username')
            this.usernames = uname
            console.log('uname--'+uname)
            /*如果cookie不存在，则跳转到登录页*/
            if(uname == ""){
                this.$router.push('/')
            }

      setInterval(() => {
        if(this.$route.path === '/home/type_msg'){
            this.routeName = '首页'
          }else if(this.$route.path === '/home/add_goods'){
            this.routeName = '添加商品'
          }else if(this.$route.path === '/home/all_goodss'){
            this.routeName = '全部商品管理 -> 商品管理'
          }else if(this.$route.path === '/home/home_wind'){
            this.routeName = '主页商品管理 -> 风琴图管理'
          }else if(this.$route.path === '/home/homele_goods'){
            this.routeName = '主页商品管理 -> 家电商品管理'
          }else if(this.$route.path === '/home/homele'){
            this.routeName = '家电馆商品管理 -> 家电商品管理'
          }else if(this.$route.path === '/home/computer'){
            this.routeName = '电脑馆商品管理 -> 电脑商品管理'
          }else if(this.$route.path === '/home/phone'){
            this.routeName = '3C数码馆商品管理 -> 3C数码商品管理'
          }else if(this.$route.path === '/home/boy'){
            this.routeName = '男装馆商品管理 -> 男装商品管理'
          }else if(this.$route.path === '/home/girl'){
            this.routeName = '女装馆商品管理 -> 女装商品管理'
          }else if(this.$route.path === '/home/user_msg'){
            this.routeName = '用户管理 -> 用户信息管理'
          }else if(this.$route.path === '/home/user_shop'){
            this.routeName = '用户管理 -> 用户购物车管理'
          }else if(this.$route.path === '/home/user_orde'){
            this.routeName = '用户管理 -> 用户订单管理'
          }else if(this.$route.path === '/home/admin_msg'){
            this.routeName = '管理员设置 -> 管理员'
          }
      },100)


    })
  },
  methods:{
    quit(){
      //删除cookie
      delCookie('username')
      this.names='',
      this.$router.push('/')
    },
    handleOpen(key, keyPath) {
      console.log(key, keyPath);
    },
    handleClose(key, keyPath) {
      console.log(key, keyPath);
    },
    home(){
      console.log('home')
      this.$router.push('/home/type_msg')
    },
    all_goodss(){
      this.$router.push('/home/all_goodss')
    },
    home_wind(){
      this.$router.push('/home/home_wind')
    },
    homele_goods(){
      this.$router.push('/home/homele_goods')
    },
    homele(){
      this.$router.push('/home/homele')
    },
    computer(){
      this.$router.push('/home/computer')
    },
    phone(){
      this.$router.push('/home/phone')
    },
    boy(){
      this.$router.push('/home/boy')
    },
    girl(){
      this.$router.push('/home/girl')
    },
    user_msg(){
      this.$router.push('/home/user_msg')
    },
    user_orde(){
      this.$router.push('/home/user_orde')
    },
    user_address(){
      this.$router.push('/home/user_address')
    },
    admin(){
      this.$router.push('/home/admin_msg')
    },
  }
}
</script>

<style lang="scss">
.home_body{
  margin: 0 auto;
  width: 1400px;
  min-height: 800px;
  // background: #ccc;
  .home_title{
    width: 1400px;
    padding: 20px 0;
    background: #2d3a4b;
    color: #ccc;
    text-align: center;
  }
  .userName{
    float: right;
    width: 1200px;
    padding: 15px 0;
    background: rgb(84, 92, 100);
    text-align: right;
    span{
      float: left;
      margin-left: 15px;
      font-size: 14px;
      color: #ccc;
    }
    h3{
      font-size: 14px;
      font-weight: normal;
      display: inline-block;
      margin-right: 8px;
      color: #ccc;
      i{
        font-size: 20px;
        font-style: normal;
        color: #fff;
      }
    }
    a{
        text-decoration: none;
        font-size: 14px;
        color: #F1DADA;
        margin-right: 15px;
    }
    a:hover{
      color:red;
    }
  }
  .nav{
    float: left;
    width: 200px;
  }
  .msg{
    width: 1200px;
    float: right;
  }
}
.el-col-12 {
    width: 200px;
}
.el-menu{
  width: 200px;
  background: rgb(84, 92, 100);
  .el-submenu{
    span{
      color:#fff;
    }
  }
  .el-submenu__title:hover{
    background:rgb(67, 74, 80);
  }
  .el-menu-item{
    color:#fff;
  }
  .el-menu-item:hover{
    background:rgb(67, 74, 80);
  }
}
</style>

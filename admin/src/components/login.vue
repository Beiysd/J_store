<template>
  <div class="body">
    <div class="mid">
      <div class="title">管理员登陆</div>
      <div class="inp">
        <i class="icon-user"></i>
        <input type="text" v-model="username" placeholder="用户名">
      </div>
      <div class="inp">
        <i class="icon-lock"></i>
        <input class="pas" v-show="pas" type="password" v-model="password" placeholder="密码">
        <input class="pas" v-show="!pas" type="text" v-model="password" placeholder="密码">
        <i class="icon-eye-blocked" @click="showPas"></i>
      </div>
      <button class="inp-btn" @click="login">登 陆</button>
    </div>
  </div>
</template>
<script>
import {setCookie,getCookie} from '../assets/js/cookie.js'
export default {
  props:['names'],
  data(){
    return{
      name:'login',
      username:'',
      password:'',
      pas:true
    }
  },
  methods:{
    showPas(){
      if(this.pas){
        this.pas = false
      }else{
        this.pas = true
      }
    },
    login(){
      if(!this.username){
        alert('用户名不得为空!')
      }else if(!this.password){
        alert('密码不得为空!')
      }else{
        console.log(this.username)
        let data={
          'username':this.username,
          'password':this.password
        }
        this.$http.post("http://127.0.0.1/sever/admin_login/login.php",data)
        .then((res)=>{
          let num = res.data
          if(num == -1){
            alert('用户名不存在!')
          }else if(num == 0){
            alert('密码错误!')
          }else{
            
            this.$emit('update:names',this.username)
            setCookie('username',this.username,1000*60)
            // 0 不记录
            // -1 关闭浏览器失效
            setTimeout(function(){
                this.$router.push('/home/type_msg')
            }.bind(this),1000)
            alert('登陆成功!')
          }
          
        })
      }
    }
  }
}
</script>
<style scoped lang="scss">
  .body{
    position: fixed;
    background: #2d3a4b;
    width: 100%;
    height: 100%;
    .mid{
      margin: 0 auto;
      margin-top: 75px;
      width: 550px;
      height: 305px;
      background: #2d3a4b;
      padding: 30px 20px;
      // border: 1px solid #999;
      // border-radius: 5px;
      .title{
        padding-bottom:35px;
        text-align: center;
        font-size: 26px;
        color:#fff;
      }
        .inp{
          padding: 15px 10px;
          border: 1px solid #999;
          border-radius: 5px;
          margin-bottom: 20px;
          .icon-user{
            font-size: 28px;
            float: left;
          }
          .icon-lock{
            font-size: 24px;
            margin-left: 7px;
            float: left;
          }
          .icon-eye-blocked{
            float: right;
            font-size: 24px;
            margin-right: 10px;
            margin-top: 4px;
            cursor: pointer;
          }
          input{
            width: 80%;
            padding: 5px 5px;
            margin-left: 10px;
            color: #fff;
            border: none;
            background: transparent;
            outline: none;
          }
          input::-webkit-input-placeholder{
            color:#fff;
        }
        }
        .inp-btn{
          padding: 15px 10px;
          border: none;
          border-radius: 5px;
          margin-bottom: 20px;
          width: 100%;
          font-size: 20px;
          cursor: pointer;
          color: #fff;
          background: #409EFF;
        }
      
    }
  }
</style>


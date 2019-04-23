<template>
    <div>
        
    </div>
</template>

<style>
    .login-wrap{text-align:center;}
    input{display:block; width:250px; height:40px; line-height:40px; margin:0 auto; margin-bottom: 10px; outline:none; border:1px solid #888; padding:10px; box-sizing:border-box;}
    p{color:red;}
    button{display:block; width:250px; height:40px; line-height: 40px; margin:0 auto; border:none; background-color:#41b883; color:#fff; font-size:16px; margin-bottom:5px;}
    span{cursor:pointer;}
    span:hover{color:#41b883;}
</style>


<script>
import {setCookie,getCookie} from '../assets/js/cookie.js'
export default{
    data(){
            return{
                showLogin: true,
                showRegister: false,
                showTishi: false,
                tishi: '',
                username: '',
                password: '',
                newUsername: '',
                newPassword: '',
                num:''
            }
    },
  mounted(){
  /*页面挂载获取cookie，如果存在username的cookie，则跳转到主页，不需登录*/
    if(getCookie('username')){
        this.$router.push('/home')
    }
  },
  methods:{
    login(){
        if(this.username == "" || this.password == ""){
            alert("请输入用户名或密码")
        }else{
            let data = {'username':this.username,'password':this.password}
            /*接口请求*/
            this.$http.post('http://127.0.0.1/sever/login/log_test.php',data)
            .then((res)=>{
                this.num = res.data;
                console.log(this.num);
          })
      }
    }
  }
}
</script>


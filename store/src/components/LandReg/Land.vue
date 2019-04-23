<template>
  <!-- <h2>Landhome</h2> -->
  <div>
      <div class="login-board">
        <div class="triangle_border_left"></div>
        <router-link to="/">
            <span class="eas">随便逛逛</span>
        </router-link>
        <h3>欢迎来到京东</h3>
            <div class="login-info">
                    <div class="input-outer"> 
                        <span class="ui-user"></span>
                        <input type="text" v-model="username" class="text" placeholder="请输入用户名"/>
                        <!-- //提示 -->
                    <p class="tishi" v-show="showTishiN">{{tishiName}}</p>

                    </div>
                    <div class="input-outer">
                        <span class="ui-loginPwd"></span>
                        <input type="password" v-model="password" class="text" placeholder="请输入密码"/>
                        <!-- //提示 -->
                    <p class="tishi" v-show="showTishiP">{{tishiPass}}</p>

                    </div>
                    
                    <div class="mb20">
                        <button class="act-but" @click="login">
                            登录
                        </button>
                    </div>
                <div class="clearfix mb20"> 
                    <a class="login-rm">
                        <span id="sp">
                            <input id="check-box" type="hidden" class="checkbox"/>
                        </span>记住用户名</a>
                    <a class="login-fgetpwd">忘记密码？</a></div>
                <div class="third-party">

                        <dd>
                            <a href="http://demo.thinksns.com/ts4/index.php?app=public&mod=Widget&act=displayAddons&type=sina&addon=Login&hook=login_sync_other" class="ico-sina"></a>
                        </dd>
                        <dd>
                            <a href="http://demo.thinksns.com/ts4/index.php?app=public&mod=Widget&act=displayAddons&type=qzone&addon=Login&hook=login_sync_other" class="ico-qzone"></a>
                        </dd>
                        <dd><a href="http://demo.thinksns.com/ts4/index.php?app=public&mod=Widget&act=displayAddons&type=weixin&addon=Login&hook=login_sync_other" class="ico-weixin_"></a></dd>

                </div>
                <div class="hasno-account">
                    <p>还没有帐号？</p>
                    <div class="other-but">
                        <router-link to="/reg" class="white-but fl"><i class="arow-left"></i>去注册</router-link>
                        <router-link to="/home" class="white-but fr">先看看<i class="arow-right"></i></router-link>
                    </div>
                </div>
            </div>
    </div>
  </div>
</template>
<script>
import {setCookie,getCookie} from '../../assets/js/cookie.js'
    export default{
        props:['names'],
        //data为工厂模式
        data(){
            return {
                name: 'Land',
                username:'',
                password:'',
                showTishiN:false,
                showTishiP:false,
                tishiName:'',
                tishiPass:'',
                userData:[],
                landId:''

            }
        },
        mounted(){
            this.$nextTick(() => {
                $("#sp").addClass('check-ok'); // 初始化时添加背景1
                $("#sp").click(function() {
                $(this).toggleClass('check-ok').toggleClass('bgNone');
                });

                // /*页面挂载获取cookie，如果存在username的cookie，则跳转到主页，不需登录*/
                 if(getCookie('username')){
                     this.$router.push('/')
                 }
            })
        },
        methods:{
            login(){
                if(this.username == "" || this.password == ""){
                    alert("请输入用户名或密码")
                }else{
                    let data = {'username':this.username,'password':this.password}
                    /*接口请求*/
                    this.$http.post('http://127.0.0.1/sever/login/log_in.php',data)
                    .then((res)=>{
                        this.num = res.data;
                        if(this.num == -1){
                            this.tishiName = "该用户不存在"
                            this.showTishiN = true
                            this.showTishiP = false
                        }else if(this.num == 0){
                            this.tishiPass = "密码输入错误"
                            this.showTishiP = true
                            this.showTishiN = false
                        }else{
                            alert("登录成功")
                            // this.showTishi = true
                            this.$emit('update:names',this.username)
                            setCookie('username',this.username,60*60)
                            // 0 不记录
                            // -1 关闭浏览器失效
                            setTimeout(function(){
                                this.$router.push('/')
                            }.bind(this),1000)
                            this.$http.post('http://127.0.0.1/sever/login/log_user.php',data)
                            .then((res)=>{
                                this.userData = res.data
                                // console.log(this.userData)
                                // console.log(this.userData[0].id)
                                this.landId = this.userData[0].id
                                let arr = 'a'
                                let shopId = {'id':arr+=this.landId}
                                this.$emit('update:dbId',shopId.id)
                            })
                        }
                    })
                }
            }
        }
    }
</script>
<style scoped>
/*向左*/
.triangle_border_left{
    width: 0;
    height: 0;
    border-width: 15px 15px 15px 0;
    border-style: solid;
    border-color: transparent 	#DC143C transparent transparent;
    position: absolute;
    top: 10px;
    left: 10px;
}
.eas{
    position: absolute;
    top: 10px;
    left: 25px;
    height: 30px;
    line-height: 30px;
    padding: 0px 10px;
    background: #DC143C;
    cursor: pointer;
    color: #fff;
    border-top-right-radius: 15px;
}
.login-board{
    position: relative;
    margin: 60px auto;
    width: 345px;
    height: 490px;
    padding: 35px;
    border: #8e8e8e 1px solid;
    background: #fff;
}
h3{
    text-align: center;
    font: 20px "microsoft yahei", Helvetica, Tahoma, Arial, "Microsoft jhengHei", sans-serif;
    height: 20px;
    line-height: 20px;
    margin-bottom: 20px;
}
form{
    margin: 0;
    padding: 0;
}
.login-info{
    margin: 0 auto;
    width: 280px;
    height: 450px;
}
.input-outer{
    height: 46px;
    border: #858585 2px solid;
    margin-bottom: 40px;
    position: relative;
    padding:0 5px;
}
.tishi{
    padding: 8px 0px;
    color: red;
}
.text{
    width: 225px;
    height: 46px;
    display: inline-block;
    font: 15px "microsoft yahei", Helvetica, Tahoma, Arial, "Microsoft jhengHei";
    color:#888;
    margin-left: 45px;
    border-style: none;
    background: none;
    line-height: 46px;
}
input:focus {outline:none;}
.ui-user,.ui-loginPwd{
    width: 25px;
    height: 25px;
    display: block;
    background: url(http://demo.thinksns.com/ts4/storage/app/public/image/login/login_ico.png);
    background-position: -125px 0;
    position: absolute;
    margin: 12px 13px;
}
.ui-loginPwd{
    background-position: -125px -35px;
}
.l-login{
    display: block;
    position: absolute;
    z-index: 1;
    left: 50px;
    top: 0;
    height: 46px;
    font: 14px "microsoft yahei", Helvetica, Tahoma, Arial, "Microsoft jhengHei";
    line-height: 46px;
}
.mb20{
    margin-bottom: 20px;
}
.submit{
    padding: 15px;
    margin-top: 20px;
    display: block;
    text-decoration: none;
}
.act-but{
    width: 280px;
    padding: 10px 0;
    border: none;
    text-align: center;
    font-size: 20px;
    color: #fff;
    border-radius: 2px;
    background: #0096e6;
    cursor: pointer;
}
.login-rm{
    color: #888;
    float: left;
    text-decoration: none;
}
#sp{
    width: 18px;
    height: 18px;
    display: inline-block;
    border: 1px solid #e5e6e7;
    margin: 0 5px 0 0;
    border-radius: 2px;
    vertical-align: middle;
    cursor: pointer;
}
.check-ok{
    background: url(http://demo.thinksns.com/ts4/storage/app/public/image/login/login_ico.png);
    background-position: -128px -70px;
    vertical-align: middle;
}
.bgNone{
    background: none;
    vertical-align: middle;
}
.login-fgetpwd{
    text-decoration: none;
    float: right;
    color: #111;
}
.third-party{
    display: flex;
    margin: 65px 0 20px 0;
    width: 280px;
    height: 32px;
    /*background: #ccc;*/
}
dd{
    flex: 1;
    height: 31px;
    float: left;
    text-align: center;
    margin: auto;
}
.ico-sina,.ico-qzone,.ico-weixin_{
    display: inline-block;
    width: 28px;
    height: 27px;
    background: url(http://demo.thinksns.com/ts4/resources/theme/stv1/_static/image/ico-account.png) no-repeat;
    cursor: pointer;
}
.ico-sina{
    background-position: -108px 0;
    margin-right: 18px;
}
.ico-qzone{
    background-position: -108px -48px;
    margin-right: 18px;
}
.ico-weixin_{
    background-position: -223px 0;
    margin-right: 18px;
}
.ico-sina:hover{
    background-position: -166px 0;
}
.ico-qzone:hover{
    background-position: -166px -48px;
}
.ico-weixin_:hover{
    background-position: -273px 0;
}
.hasno-account{
    margin-top: 30px;
    border-top: #858585 1px solid;
    position: relative;
}
.hasno-account p {
    position: absolute;
    padding: 0px 5px;
    text-align: center;
    font-size: 16px;
    height: 16px;
    line-height: 16px;
    top: -11px;
    background: #fff;
    left: 94px;
}
.other-but{
    margin-top: 40px;
}
.white-but {
    display: inline-block;
    padding: 10px 30px;
    font-size: 20px;
    text-decoration: none;
    color: #111;
    line-height: 20px;
    border: #858585 1px solid;
    border-radius: 2px;
    cursor: pointer;
}
.fl {
    float: left;
}
.fr{
    float: right;
}
.arow-left,.arow-right{
    width: 12px;
    height: 20px;
    display: inline-block;
    background: url(http://demo.thinksns.com/ts4/storage/app/public/image/login/login_ico.png);
    vertical-align: middle;
}
.arow-left {
    background-position: -130px -101px;
    margin-right: 5px;
}
.arow-right {
    background-position: -130px -133px;
    margin-left: 5px;
}
</style>

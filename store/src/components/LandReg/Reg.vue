<template>
  <div>
      <div class="reg-main">
                <!--注册步骤-->
                <h3>欢迎来到京东</h3>
                <!--邮箱注册-->
                <div class="info-list clearfix"> 
                    <span class="input-outer">
                        <i class="ui-mail"></i>
                    </span>
                    <input v-model="email" class="inp01" event-node="email" event-args="suffix=" placeholder="输入常用邮箱" name="email" checkurl="http://demo.thinksns.com/ts4/index.php?app=public&mod=Register&act=isEmailAvailable" autocomplete="off" type="text" value=""/>
                    <div class="icon-cross" v-show="hid01"> 输入错误，请重新输入！</div>
                    <div class="icon-checkmark" v-show="show01"> 输入正确！</div>
                </div>
                <div class="info-list clearfix"> 
                    <span class="input-outer">
                        <i class="ui-phone"></i>
                    </span>
                    <input v-model="phone" class="inp02" event-node="phone" event-args="suffix=" placeholder="输入手机号" name="phone" checkurl="http://demo.thinksns.com/ts4/index.php?app=public&mod=Register&act=isEmailAvailable" autocomplete="off" type="text" value="" />
                    <div class="icon-cross" v-show="hid02"> 输入错误，请重新输入！</div>
                    <div class="icon-checkmark" v-show="show02"> 输入正确！</div>
                </div>
                <div class="info-list clearfix"> 
                    <span class="input-outer"> 
                        <i class="ui-nickname"></i>
                        </span>
                    <input v-model="uname" class="inp03" event-node="uname" placeholder="设置昵称：限2-10个字符" name="uname" checkurl="http://demo.thinksns.com/ts4/index.php?app=public&mod=Register&act=isUnameAvailable" autocomplete="off" type="text" value="" />
                    <div class="icon-cross" v-show="hid03"> 请输入2-10个字符的昵称!</div>
                    <div class="icon-checkmark" v-show="show03"> 输入正确！</div>
                </div>
                <div class="info-list clearfix"> 
                    <span class="input-outer"> 
                        <i class="ui-password"></i>
                    </span>
                    <input v-model="password" class="inp04"  name="password" type="password" placeholder="设置密码：限6-15个字符，区分大小写" value="" />
                    <div class="icon-cross" v-show="hid04"> 请输入6-15个字符，区分大小写!</div>
                    <div class="icon-checkmark" v-show="show04"> 输入正确！</div>
                </div>
                <div class="info-list clearfix"> 
                    <span class="input-outer"> 
                        <i class="ui-password"></i>
                    </span>
                    <input v-model="repassword" class="inp05" name="repassword" type="password"  placeholder="再次输入密码" value="" />
                    <div class="icon-cross" v-show="hid05"> 输入密码不一致！</div>
                    <div class="icon-checkmark" v-show="show05"> 输入一致！</div>
                </div>
                <button class="hid" v-show="!this.showReg">
                    <a>注册</a>
                </button>
                <button class="next" v-show="this.showReg">
                    <a @click="regist">注册</a>
                </button>
      </div>
  </div>
</template>
<script>
import {setCookie,getCookie} from '../../assets/js/cookie.js'
    export default{
        props:['names','dbId'],
        //data为工厂模式
        data(){
            return {
                name: 'Reg',
                email:'',
                phone:'',
                uname:'',
                password:'',
                repassword:'',
                hid01:false,
                hid02:false,
                hid03:false,
                hid04:false,
                hid05:false,
                show01:false,
                show02:false,
                show03:false,
                show04:false,
                show05:false,
                showReg:false,
                regId:'',
                userData:[]
            }
        },
        mounted(){
        },
        // 监听事件
        watch:{
            email(oldVal,newVal){
                if(oldVal != newVal){
                    this.inp01()
                    this.inp06()
                }
            },
            phone(oldVal,newVal){
                if(oldVal != newVal){
                    this.inp02()
                    this.inp06()
                }
            },
            uname(oldVal,newVal){
                if(oldVal != newVal){
                    this.inp03()
                    this.inp06()
                }
            },
            password(oldVal,newVal){
                if(oldVal != newVal){
                    this.inp04()
                    this.inp05()
                    this.inp06()
                }
            },
            repassword(oldVal,newVal){
                if(oldVal != newVal){
                    this.inp05()
                    this.inp06()
                }
            },
        },
        methods:{
            inp01(){
                // console.log(this.email)
                // 邮箱正则
                let em = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
                if(em.test(this.email)){
                    this.hid01 = false
                    this.show01 = true
                }else{
                    this.hid01 = true
                    this.show01 = false
                }
            },
            inp02(){
                // 手机正则
                let ph = /^[1][34578]\d{9}$/;
                if(ph.test(this.phone)){
                    this.hid02 = false
                    this.show02 = true
                }else{
                    this.hid02 = true
                    this.show02 = false
                }
            },
            inp03(){
                // 昵称正则
                let un = /^[A-Za-z0-9_\-\u4e00-\u9fa5]{2,10}$/;
                if(un.test(this.uname)){
                    this.hid03 = false
                    this.show03 = true
                }else{
                    this.hid03 = true
                    this.show03 = false
                }
            },
            inp04(){
                // 密码正则
                let pa = /^[A-Za-z0-9]{6,15}$/;
                console.log('pas'+this.password)
                if(pa.test(this.password)){
                    this.hid04 = false
                    this.show04 = true
                }else{
                    this.hid04 = true
                    this.show04 = false
                }
            },
            inp05(){
                // 密码验证
                 console.log('repas'+this.repassword)
                 
                if(this.password == this.repassword && this.repassword){
                    console.log('ques')
                    this.hid05 = false
                    this.show05 = true
                    
                 }else{
                    this.hid05 = true
                    this.show05 = false
                }
                
            },
            inp06(){
                if(this.show01 && this.show02 && this.show03 && this.show04 && this.show05){
                    this.showReg = true
                }else{
                    this.showReg = false
                }
            },
            //注册
            regist(){
                console.log('开始')
                let data = {
                    'email':this.email,
                    'phone':this.phone,
                    'username':this.uname,
                    'password':this.password
                }
                this.$http.post("http://127.0.0.1/sever/reg/reg.php",data)
                .then((res)=>{
                    let resnum = res.data
                    //注册成功即登陆
                    if(resnum == 0){
                        alert('该用户名已存在!')
                    }else{
                        alert('注册成功，即将登陆!')
                        this.$emit('update:names',this.uname)
                        setCookie('username',this.uname,1000*60)
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
                            this.regId = this.userData[0].id
                            let arr = 'a'
                            let shopId = {'id':arr+=this.regId}
                            this.$emit('update:dbId',shopId.id)
                            this.$http.post('http://127.0.0.1/sever/shopcar/shop.php',shopId)
                            .then((res)=>{})
                        })
                    }
                })
            }
        }
    }
</script>
<style scoped lang="scss">
.reg-main{
    position: relative;
    margin: 60px auto;
    padding: 35px;
    width: 422px;
    height: 555px;
    border:1px solid #ccc;
    background: #fff;
    h3{
        text-align: center;
        font: 20px "microsoft yahei", Helvetica, Tahoma, Arial, "Microsoft jhengHei", sans-serif;
        height: 20px;
        line-height: 20px;
        margin-bottom: 20px;
    }
    .info-list{
        position: relative;
        margin-bottom: 30px;
        .input-outer{
            float: left;
            margin-bottom: 40px;
            border: 1px solid #858585;
            border-right: none;
            width: 50px;
            height: 48px;
            .ui-mail,.ui-phone,.ui-nickname,.ui-password{
                width: 25px;
                height: 25px;
                display: inline-block;
                background: url(http://demo.thinksns.com/ts4/storage/app/public/image/login/login_ico.png);
                background-position: -85px 0;
                position: absolute;
                margin: 12px 11px;
            }
            .ui-phone{
                height: 31px;
                margin: 8px 11px;
                background-position: -85px -108px;
            }
            .ui-nickname{
                margin: 14px 11px;
                background-position: -85px -35px;
            }
            .ui-password{
                height: 30px;
                margin: 8px 11px;
                background-position: -85px -65px;
            }
        }
        .inp01,.inp02,.inp03,.inp04,.inp05{
            // float: left;
            border: 1px solid #858585;
            border-left: none;
            height: 48px;
            line-height: 48px;
            width: 370px;
            color: #888;
            font: 16px "microsoft yahei", Helvetica, Tahoma, Arial, "Microsoft jhengHei", sans-serif;
            background: none;
            outline: none;
        }
        .icon-cross,.icon-checkmark{
            float: right;
            line-height: 45px;
            font-size: 12px;
            color: #e83632;
        }
        .icon-checkmark{
            color: green;
        }
    }
   
    .next,.hid{
        position: absolute;
        margin-left:15%;
        width: 200px;
        height: 50px;
        line-height:50px;
        margin-top: 25px;
        text-align: center;
        border: none;
        font-size: 20px;
        color: #fff;
        border-radius: 2px;
        background: #0096e6;
        cursor: pointer;
        a{
            color: #fff;
        }
    }
     .hid{
        background: #ccc;
    }

}
</style>

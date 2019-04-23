<template>
  <div id="app">
    <isLoading v-if="Loading"></isLoading>
    
    <div v-else>
      <div class="appHead">
        <div class="appHeadSmall">
          <router-link to="/">
          <div class="icon-home31"></div><i>首页</i>
          </router-link>
          <div class="icon-location21"></div><div class="address">{{prov}}</div>
          <!-- <router-link to="/phoneapp"> -->
            <div class="type-use last" @click="shoporde">订单记录</div>
          <!-- </router-link> -->
          <!-- <router-link to="/shopcar">
            <div class="type-use">购物车</div>
          </router-link> -->
          <div class="type-use" @click="shopcar">购物车</div>
          <router-link to="/reg" v-show="this.hidUser">
            <div class="type-use">免费注册</div>
          </router-link>
          
          <div class="log-out" v-show="showUser">
            <a href="#" @click="quit">注销登录</a>
          </div>
          <div class="type-hu" v-show="this.showUser">
            欢迎 <span class="use-st">{{names}}</span>
          </div>
          <router-link to="/land" v-show="this.hidUser">
            <div class="type-use">请登录</div>
          </router-link>
        </div>
      </div>
      <!-- 反向传值 -->
      <!-- <router-view :home="home" :allmes="allmes" :details.sync="details" :sellNum.sync="sellNum"></router-view> -->
      <!-- <keep-alive> -->
        <router-view :allPrice.sync="allPrice" :orderGoods.sync="orderGoods" :dbId.sync="dbId" :names.sync="names" :home="home" :allmes="allmes" :goodsDetail="goodsDetail" :username="names"></router-view>
      <!-- </keep-alive> -->
      <div class="appFoot clearfix">
        <div class="foot-num1">
          <div class="foot-img">
            <img src="https://img13.360buyimg.com/cms/jfs/t25498/324/1328641225/26734/47b02704/5bae443aN44e50581.jpg!q80.webp" alt="">
          </div>
        </div>
        <div class="foot-num2">
          <div class="foot-types">
            <span class="item fore1"><i></i>品类齐全，轻松购物</span>
            <span class="item fore2"><i></i>多仓直发，极速配送</span>
            <span class="item fore3"><i></i>正品行货，精致服务</span>
            <span class="item fore4"><i></i>天天低价，畅选无忧</span>
          </div>
        </div>
        <div class="foot-num3">
          <div class="style">
            <div class="types">
              <span>购物指南</span>
              <li>购物流程</li>
              <li>会员介绍</li>
              <li>生活旅行/团购</li>
              <li>常见问题</li>
              <li>联系客服</li>
            </div>
            <div class="types">
              <span>配送方式</span>
              <li>上门自提</li>
              <li>211限时达</li>
              <li>配送服务查询</li>
              <li>配送费收取标准</li>
              <li>海外配送</li>
            </div>
            <div class="types">
              <span>支付方式</span>
              <li>货到付款</li>
              <li>在线支付</li>
              <li>分期付款</li>
              <li>邮局汇款</li>
              <li>公司转账</li>
            </div>
            <div class="types">
              <span>售后服务</span>
              <li>售后政策</li>
              <li>价格保护</li>
              <li>退款说明</li>
              <li>返修/退换货</li>
              <li>取消订单</li>
            </div>
            <div class="types">
              <span>特色服务</span>
              <li>夺宝岛</li>
              <li>DIY装机</li>
              <li>延保服务</li>
              <li>京东E卡</li>
              <li>京东通信</li>
              <li>京东JD+</li>
            </div>
          </div>
        </div>
        <div class="foot-num4">
          <div class="about-types">
            <li>关于我们</li>
            <li>联系我们</li>
            <li>联系客服</li>
            <li>合作招商</li>
            <li>商家帮助</li>
            <li>营销中心</li>
            <li>手机京东</li>
            <li>友情链接</li>
            <li>销售联盟</li>
            <li>京东社区</li>
            <li>风险监测</li>
            <li>隐私政策</li>
            <li>京东公益</li>
            <li>English Site</li>
            <li>Media & IR</li>
          </div>
          <p>
            <a>京公网安备 11000002000088号</a>
            <a>京ICP证070359号</a>
            <a>互联网药品信息服务资格证编号(京)-经营性-2014-0008</a>
            <a>新出发京零 字第大120007号</a>
          </p>
          <p>
            <a>互联网出版许可证编号新出网证(京)字150号</a>
            <a>出版物经营许可证</a>
            <a>网络文化经营许可证京网文[2014]2148-348号</a>
            <a>违法和不良信息举报电话：4006561155</a>
          </p>
          <p>
            <a>Copyright © 2004 - 2019 京东JD.com 版权所有</a>
            <a>消费者维权热线：4006067733</a>
            <a>经营证照</a>
            <a>(京)网械平台备字(2018)第00003号</a>
            <a>营业执照</a>
          </p>
          <div class="end">
            <a class="link link1" href="http://www.cyberpolice.cn/wfjb/">可信网站信用评估</a>
            <a class="link link2" href="http://www.cyberpolice.cn/wfjb/">网络警察提醒你</a>
            <a class="link link3" href="http://www.cyberpolice.cn/wfjb/">诚信网站</a>
            <a class="link link4" href="http://www.cyberpolice.cn/wfjb/">中国互联网举报中心</a>
            <a class="link link5" href="http://www.cyberpolice.cn/wfjb/">网络举报APP下载</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {setCookie,getCookie,delCookie} from './assets/js/cookie.js'
import isLoading from './public/isLoading.vue'
export default {
  name: 'App',
  data(){
      return{
          allmes:'',
          Loading:false,
          prov:'',
          home:'',
          details:'',
          sellNum:'',
          goodsDetail:[],
          dbId:'',
          names:'',
          userName:'',
          showUser:false,
          hidUser:true,
          orderGoods:[],
          allPrice:''
      }
  },
  components:{isLoading},
  created(){
    this.$nextTick(() => {
//IP定位数据
        this.axios.get('api/address')
          .then(res => {
            res = JSON.parse(res.data)
            console.log(res)
            if(res.status === 0){
              let timer = setTimeout(() => {
                  this.Loading = true
              },2000)
              this.prov = res.result.ad_info.province
              clearTimeout(timer)
            }
            // this.$router.push('/')
          }),
//home页面数据
        this.axios.get('api/home')
          .then(res => {
            res = res.data
            if(res.errno === 0){
              this.home = res.data
            }
          })
    })
  },
  watch:{
      prov(oldVal,newVal){
          if(oldVal != newVal){
            //总商品数据
            this.axios.get('api/shopmes')
              .then(res => {
                res = res.data
                if(res.errno === 0){
                  // let timer = setTimeout(() => {
                  //     this.Loading = true
                  // },1000)
                  this.allmes = res.data
                  // clearTimeout(timer)
                }
              })
          }
      },
      names(oldVal,newVal){
      if(oldVal != newVal && !newVal){
        this.showUser = true
        this.hidUser = false
        console.log(this.names)
      }else{
        this.showUser = false
        this.hidUser = true
      }
    }
  },
  mounted(){
    this.$nextTick(() => {
      this.goodsDetail.push(this.details)
      console.log('gd'+this.goodsDetail)
      /*页面挂载获取保存的cookie值，渲染到页面上*/
            let uname = getCookie('username')
            this.names = uname
            /*如果cookie不存在，则跳转到登录页*/
            if(uname == ""){
                this.$router.push('/land')
            }
    })
  },
  methods:{
    quit(){
      //删除cookie
      delCookie('username')
      this.names='',
      this.dbId=''
      this.$router.push('/')
    },
    shopcar(){
      let uname = getCookie('username')
      /*如果cookie不存在，则跳转到登录页*/
      if(uname == ""){
          alert('请登录!')
      }else{
        this.$router.push('/shopcar')
      }
    },
    shoporde(){
      let uname = getCookie('username')
      /*如果cookie不存在，则跳转到登录页*/
      if(uname == ""){
          alert('请登录!')
      }else{
        this.$router.push('/phoneapp')
      }
    }
  }
}
</script>

<style lang="scss">
*{
  margin:0;
  padding:0;
  -webkit-font-smoothing:antialiased;
  list-style:none;
  text-decoration:none;
}
.clearfix{
  clear: both;
}
body{
  min-width: 1500px;
  background:#fff;
}
.appHead{
  position:relative;
  width:100%;
  min-width:1200px;
  height:30px;
  background:#e3e4e5;
  border-bottom: 1px solid #ccc;
  overflow:hidden;
  .appHeadSmall{
    position:relative;
    margin:0 auto;
    width:1200px;
    .icon-home31,.icon-location21{
    display:inline-block;
    margin-top:7px;
    margin-left:15px;
    font-size:14px;
    color:#5c5452;
  }
  .icon-location21{
    color:#f10215;
    margin-left:35px;
  }
  i,.address{
    position:absolute;
    display:inline-block;
    margin:0px 5px;
    margin-top:6px;
    font-style:normal;
    font-size:12px;
    color:#999;
    cursor:pointer;
  }
  i:hover,.type-use:hover{
    color:red;
  }
  .type-use,.type-hu,.log-out{
    float:right;
    padding:0px 15px;
    margin-top:6px;
    font-size:12px;
    color:#999;
    cursor:pointer;
    border-right:1px solid #ccc;

  }
  .type-hu{
    line-height: 16px;
    .use-st{
      color:#d13030;
      margin-left: 10px;
      font-size: 15px;
    }
  }
  .type-use.last{
    border:0px;
  }
  & > a{
      color:#999;
    }
  & > .active{
    color:red;
    .type-use{
      color:red;
    }
  }
  }
}
.appFoot{
  width:100%;
  min-width:1200px;
  margin-top: 120px;
  .foot-num1{
    background:#fff;
    .foot-img{
      margin:0 auto;
      width:1200px;
      overflow:hidden;
      img{
        float:left;
        margin-left:35px;
      }
    }
  }
  .foot-num2{
    width:100%;
    min-width:1200px;
    border-bottom:1px solid #ccc;
    .foot-types{
      margin:0 auto;
      display:flex;
      padding:30px 0px;
      width:1100px;
      box-sizing:border-box;
      .item{
        flex:1;
        position:relative;
        font-size:18px;
        font-weight:700;
        color:#444;
        text-indent:80px;
      }
      .item i{
        display:block;
        position:absolute;
        top:-8px;
        left:35px;
        width:36px;
        height:42px;
        background:url('https://misc.360buyimg.com/jdf/1.0.0/unit/service/5.0.0/i/ico_service.png');
        background-repeat:no-repeat;
        background-position:0 0;
      }
      .fore2 i{
        background-position:0 -43px;
      }
      .fore3 i{
        background-position:0 -86px;
      }
      .fore4 i{
        background-position:0 -129px;
      }
    }
  }
  .foot-num3{
    box-sizing:border-box;
    width:100%;
    min-width:1200px;
    padding:20px 0px;
    border-bottom:1px solid #ccc;
    .style{
      margin:0 auto;
      display:flex;
      width:1200px;
      overflow:hidden;
      .types{
        flex:1;
        span,li{
          text-indent:92px;
        }
        span{
          display:block;
          margin-bottom:8px;
          font-weight:700;
          font-size:14px;
          color:#777;
        }
        li{
          height:22px;
          font-size:12px;
          color:#666;
          cursor:pointer;
          overflow:hidden;
        }
        li:hover{
          color:red;
        }
      }
    }
  }
  .foot-num4{
    box-sizing:border-box;
    padding-top:20px;
    padding-bottom:60px;
    width:100%;
    min-width:1200px;
    .about-types{
      margin:0 auto;
      width:1200px;
      padding-bottom:30px;
      li{
        float:left;
        padding:0px 10px;
        font-size:12px;
        color:#666;
        cursor:pointer;
        border-right:1px solid #ccc;
      }
      li:hover{
        color:red;
      }
      li:first-child{
        margin-left:65px;
      }
      li:last-child{
        border:0px;
      }
    }
    p{
      box-sizing:border-box;
      width:1200px;
      margin:0 auto;
      padding:2px 0px;
      text-align:center;
      a{
        padding:0px 5px;
        font-size:12px;
        color:#999;
        cursor:pointer;
        border-right:1px solid #ccc;
      }
      a:hover{
        color:red;
      }
      a:last-child{
        border:0px;
      }
    }
    .end{
      margin:0 auto;
      padding-top:20px;
      width:1200px;
      text-align:center;
      .link{
        display:inline-block;
        margin:0 3px;
        width:103px;
        height:32px;
        text-indent:-9999px;
        background:url('https://misc.360buyimg.com/jdf/1.0.0/unit/global-footer/5.0.0/i/ico_footer.png');
      }
      .link1{
        background-position:-104px 0px;
      }
      .link2{
        background-position:0px -33px;
      }
      .link3{
        background-position:-104px -33px;
      }
      .link4{
        background-position:0px -66px;
      }
      .link5{
        background-position:-104px -66px;
      }
    }
  }
}
</style>

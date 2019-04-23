<template>
    <div>
        <div class="addre" v-for="(ite,index) in carList" :key="index" v-show="ite.time">
        <!-- <h3>address</h3> -->
        <!-- 省，市，县 + 具体地址 -->
            <div class="add-title">时间 <i class="time">{{ite.time}}</i>
                <i class="type">
                    <!-- <span class="icon-circle-right" @click="times_right(ite.time,index)"></span>
                    <span  class="icon-circle-down"></span> -->
                    <i @click="times_right(ite.time,index)">显示</i>
                    <i @click="times_down(ite.time,index)">收起</i>
                </i>
            </div>
            <div v-show="nnm===index">
                <div><i class="inp-st">省区：</i>  <i class="inp-s">{{addR.prov}}</i></div>
                <div><i class="inp-st">城市：</i>  <i class="inp-s">{{addR.city}}</i></div>
                <div><i class="inp-st">街道：</i>  <i class="inp-s">{{addR.road}}</i></div>
                <div><i class="inp-st">备注： </i>  <i class="inp-s">{{addR.msg}}</i></div>
                <div><i class="inp-st">收件人：</i>  <i class="inp-s">{{addR.name}}</i> </div>
                <div><i class="inp-st">收件人电话：</i>  <i class="inp-s">{{addR.phone}}</i></div>
                <div><i class="inp-st">邮编：</i>  <i class="inp-s"></i>{{addR.post}}</div>
                <div class="inp-style" v-for="(item,index) in times" :key="index">
                    <div>
                        
                        <img :src="item.imgurl" alt="">
                        <div class="gn">{{item.name}}</div>
                        <div class="gp">单价：{{item.price}}</div>
                        <div class="gnu">数量：{{item.num}}</div>
                        <div class="gt">小计：{{(item.price * item.num).toFixed(2)}}</div>
                    </div>
                    <div class="ttP ts">状态： {{item.type}}</div>
                </div>
                <div class="ttP">总价：{{total_price}} 元</div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['names'],
    data(){
        return{
            name:'phoneapp',
            userName:'',
            carList:[],
            userDate:[],
            userId:'',
            upId:'',
            orderGoods:[],
            ordeAddr:[],
            addR:[],
            ordeShow:true,
            nnm:'',
            nnt:'',
            goods_all:[],
            goodssel:[],
            totalPrice:'',
            price:''
        }
    },
    mounted(){
        this.$nextTick(() => {
            setInterval(() => {
                this.userName = this.names
                if(this.$route.path === '/order'){
                    // this.orde()
                }
            },100)
            this.times_right()
        })
    },
    created(){
        console.log(this.names)
        let data = {'name':this.names}
        this.$http.post("http://127.0.0.1/sever/shopcar/shop_userid.php",data)
        .then((res)=>{
            this.userDate = res.data
            this.userId = this.userDate[0].id
            let arr = 'a'
            this.upId = {"id":arr+=this.userId}
            console.log(this.upId)
            this.$http.post("http://127.0.0.1/sever/shopcar/orde_man.php",this.upId)
            .then((res)=>{
                this.carList = res.data
                console.log(this.carList)
                this.$http.post("http://127.0.0.1/sever/shopcar/orde_address.php",this.upId)
                .then((res)=>{
                    this.ordeAddr = res.data
                    console.log(this.ordeAddr)
                    this.$http.post("http://127.0.0.1/sever/shopcar/orde_goods.php",this.upId)
                    .then((res)=>{
                        this.orderGoods = res.data
                        console.log(this.orderGoods)
                        
                    })
                })
            })
        })
    },
    watch:{

    },
    methods:{
        times_right(val1,val2){
            this.nnm = val2
            this.nnt = val1
            this.ordeAddr.findIndex((item,index) => {
                if(item.time == val1){
                    // console.log('false--'+item.id)
                    // console.log('fa--'+index)
                    this.addR = item
                    console.log(this.addR)
                }
            })
        },times_down(val1,val2){
            this.nnm = -(val2+1)
        }
    },
    computed:{
         selShops(){
            return this.$route.params.selShops
        },
        toPrice(){
            return this.$route.params.toPrice
        },
        times(){
            if(!this.nnt){
                return ['']
            }
            return this.orderGoods.filter(f => {
                let reg = new RegExp(this.nnt,'img')
              console.log('0')
              return reg.test(f.time)
            })
        },
        //总价
        total_price() {
            let price = 0　　　　　　　　　　　　　　　　　　　　　　　
            this.times.forEach(item => {
        //总价 = 价格 * 数量
        // Number(item.num)
                price += Number(item.price) * Number(item.num)
                this.goodssel = this.times
                console.log(this.goodssel)
            })
            return price.toFixed(2)
        }
    }
}
</script>
<style scoped lang="scss">
    .addre{
        float: left;
        position: relative;
        margin-left: 37px;
        margin-top: 15px;
        width: 450px;
        padding: 0px 5px 0px 5px;
        border: 1px solid #ccc;
        border-top: 0px;
        border-radius: 5px;
        .add-title{
            position: relative;
            box-sizing: border-box;
            border: 1px solid #ccc;
            padding: 12px;
            font-size: 22px;
            margin-bottom: 20px;
            color: #fff;
            background: #e83632;
            border-radius: 5px;
            width: 450px;
            outline: none;
            .time{
                font-size: 14px;
                font-style: normal;
            }
            .type{
                float: right;
                font-style: normal;
                cursor: pointer;
                .icon-circle-down{
                    display: none;
                }
                i{
                    font-style: normal;
                    font-size: 16px;
                }
                
            }
        }
        .inp-st{
            display: inline-block;
            // width: 120px;
            text-indent: 4px;
            font-size: 18px;
            font-style: normal;
            margin-bottom: 10px;
        }
        .inp-s{
            display: inline-block;
            font-size: 14px;
            font-style: normal;
            font-weight: 700;
        }
        .inp-style{
            box-sizing: border-box;
            border: 1px solid #ccc;
            padding: 5px;
            font-size: 14px;
            margin-bottom: 20px;
            color: #333;
            border-radius: 5px;
            width: 450px;
            outline: none;
            img{
                margin-left: -405px;
                width: 60px;
                height: 60px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            .gn,.gp,.gnu,.gt{
                float: left;
                font-size: 14px;
                background: #ccc;
                border-radius: 5px;
            }
            .gn{
                width: 120px;
                margin-top: 11px;
                margin-left: 73px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
                overflow: hidden;
            }
            .gp{
                margin-left: 10px;
                width: 58px;
                margin-top: 12px;

            }
            .gnu{
                margin-left: 10px;
                margin-top: 12px;
                width: 50px;
            }
            .gt{
                margin-top: 12px;
                margin-left: 10px;
                width: 78px;
            }
            .gty{
                background: #ccc;
            }
        }
        .inp-sts{
            .inp-sma01,.inp-sma02{
                width: 100px;
                padding: 10px 15px;
                background: #e83632;
                border-radius: 5px;
                text-align: center;
                color: #fff;
            }
            .inp-sma01{
                float: left;
            }
            .inp-sma02{
                float: right;
            }
        }
        .ttP{
            margin-bottom: 20px;
            width: 135px;
            padding: 10px 15px;
            background: #e83632;
            border-radius: 5px;
            text-align: center;
            color: #fff;
        }
        .ts{
            position: absolute;
            bottom: 0;
            right: 5px;
        }
    }
</style>



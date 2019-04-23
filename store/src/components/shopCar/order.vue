<template>
    <div class="addre">
        <!-- <h3>address</h3> -->
        <!-- 省，市，县 + 具体地址 -->
        <div class="add-title">订单<i @click="ordeMan">订单管理</i></div>
        <div><i class="inp-st">省区：</i>  <i class="inp-s">{{this.carList[0].prov}}</i></div>
        <div><i class="inp-st">城市：</i>  <i class="inp-s">{{this.carList[0].city}}</i></div>
        <div><i class="inp-st">街道：</i>  <i class="inp-s">{{this.carList[0].road}}</i></div>
        <div><i class="inp-st">备注： </i>  <i class="inp-s">{{this.carList[0].msg}}</i></div>
        <div><i class="inp-st">收件人：</i>  <i class="inp-s">{{this.carList[0].name}}</i> </div>
        <div><i class="inp-st">收件人电话：</i>  <i class="inp-s">{{this.carList[0].phone}}</i></div>
        <div><i class="inp-st">邮编：</i>  <i class="inp-s">{{this.carList[0].post}}</i></div>
        <div class="inp-style" v-for="(item,index) in orderGoods" :key="index">
            <div>
                <img :src="item.imgurl" alt="">
                <div class="gt">小计：{{(item.price * item.num).toFixed(2)}}</div>
                <div class="gnu">数量：{{item.num}}</div>
                <div class="gp">单价：{{item.price}}</div>
                <div class="gn">{{item.name}}</div>
            </div>
        </div>
        <div class="ttP">总价：{{allPrice}} 元</div>
        <div class="inp-sts">
            <router-link to="/shopcar">
                <div class="inp-sma01">离开</div>
            </router-link>
            <router-link to="/phoneapp">
                <div class="inp-sma02">去支付</div>
            </router-link>
        </div>
    </div>
</template>
<script>
export default {
    props:['names','allPrice'],
    data(){
        return{
            name:'order',
            userName:'',
            carList:[],
            userDate:[],
            userId:'',
            orderGoods:[]
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
            let upId = {"id":arr+=this.userId}
            console.log(upId)
            this.$http.post("http://127.0.0.1/sever/shopcar/shop_order.php",upId)
            .then((res)=>{
                this.carList = res.data
                console.log(this.carList[0].time)
                let ar = 'a'
                let dat = {
                    "id":ar+=this.userId,
                    "time":this.carList[0].time
                }
                this.$http.post("http://127.0.0.1/sever/shopcar/orders.php",dat)
                .then((res)=>{
                    this.orderGoods = res.data
                })
            })
        })
    },
    watch:{},
    methods:{
        ordeMan(){
            this.$router.push('/phoneapp')
        }
    },
    computed:{
         selShops(){
            return this.$route.params.selShops
        },
        toPrice(){
            return this.$route.params.toPrice
        }
    }
}
</script>
<style scoped lang="scss">
    .addre{
        margin: 0 auto;
        width: 810px;
        padding: 0px 5px 52px 5px;
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
            width: 810px;
            outline: none;
            i{
                float: right;
                font-style: normal;
                cursor: pointer;
            }
        }
        .inp-st{
            display: inline-block;
            width: 120px;
            text-indent: 4px;
            font-size: 18px;
            font-style: normal;
            margin-bottom: 10px;
        }
        .inp-s{
            display: inline-block;
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
        }
        .inp-style{
            box-sizing: border-box;
            border: 1px solid #ccc;
            padding: 33px;
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            border-radius: 5px;
            width: 810px;
            outline: none;
            img{
                width: 100px;
                height: 94px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            .gn,.gp,.gnu,.gt{
                float: right;
                background: #ccc;
                border-radius: 5px;
            }
            .gn{
                width: 220px;
                margin-top: -94px;
                margin-right: 400px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp:2;
                overflow: hidden;
            }
            .gp{
                width: 110px;
                margin-right: 26px;
                margin-top: 8px;

            }
            .gnu{
                margin-right: 30px;
                margin-top: 8px;
                width: 80px;
            }
            .gt{
                width: 130px;
                margin-top: 8px;
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
            margin: 0 auto;
            margin-bottom: 20px;
            width: 200px;
            padding: 10px 15px;
            background: #e83632;
            border-radius: 5px;
            text-align: center;
            color: #fff;
        }
    }
</style>



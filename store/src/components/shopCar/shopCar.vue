<template>
  <div>
        <div class="fixTitle" v-show="shopShow">
            <div class="fixs">
                <h3>现在这里空空如也，快去添加商品吧！</h3>
            </div>
        </div>

        <!-- 商品列表 -->
        <div class="shops" v-show="!shopShow">
            <h3 class="carName">购 物 车</h3>
           <table>
            <tr>
                <th class="th01"><label><input class="checkBox" type="checkbox" @click="check_all" :checked="choiceGoods.length == carList.length"/>全选</label></th>
                <th class="th02">商品名称</th>
                <th class="th03">商品ID</th>
                <th class="th04">商品详情</th>
                <th class="th05">商品价格</th>
                <th class="th06">数量</th>
                <th class="th07">小计</th>
                <th class="th08">操作</th>
            </tr>
            <tr class="tr-td" v-for="(item,index) in carList" :key="index">
                <td class="td01">
                    <input class="checkBox" id="bbox" type="checkbox" :value="item" v-model="choiceGoods"/>
                </td>
                
                 <td class="td02">
                    <router-link :to="{name:'Detail',params:{goodsDetail:carList[index]}}">
                    <span class="shopImg"><img :src="item.imgurl" alt=""></span><span class="shopName">{{item.name}}</span>
                    </router-link>
                </td>
                <td>{{item.id}}</td>
                <td class="td03">{{item.tjremake}}</td>
                <td class="td04"><i>RMB</i> {{item.price}}</td>
                <td class="col">
                    <div class="icon-minus" v-on:click="minus(item)"></div>
                    <input class="btn-group" type="text" v-model="item.num" />
                    <div class="icon-plus" v-on:click="plus(item)"></div>
                </td>
                <td class="td06"><i>RMB</i> {{(item.price * item.num).toFixed(2)}}</td>
                <td>
                    <button class="btn" @click="delete_goods(item.id)">删 除</button>
                </td>
            </tr>
           </table>
            <div class="allPrice">
                <div class="pull-right">
                    合计：{{total_price}}元
                </div>
            </div>
            <div class="next tt" v-show="total_price<=0">
                下一步
            </div>
            <router-link :to="{name:'address',params:{goodsSel:this.goodssel,allMoney:total_price}}" v-show="total_price>0">
                <div class="next">
                    下一步
                </div>
            </router-link>
        </div>

        
    </div>
</template>
<script>
    export default{
    props:['names','orderGoods','allPrice'],
        //data为工厂模式
        data(){
            return {
                name: 'shopCar',
                shopShow:true,
                shopHid:false,
                choiceGoods:[],//已选商品,
                goodNum:'',
                nums:'',
                shopHeigh:'',
                waitPrice:'',
                totalPrice:'',
                carList:[],
                userName:'',
                userDate:[],
                userId:'',
                goodssel:[]
            }
        },
        created(){},
        mounted(){
            this.$nextTick(() => {
                setInterval(() => {
                    this.userName = this.names
                    this.shopsShow()
                },100)
                //默认全选
                // this.allCheck()
            })
        },
        watch:{
            choiceGoods(oldVal,newVal){
                console.log(this.dbId)
                if(oldVal != newVal){
                    console.log(this.choiceGoods)
                }
            },
            userName(oldVal,newVal){
                if(oldVal || newVal){
                    console.log(this.names)
                        let data = {'name':this.names}
                        this.$http.post("http://127.0.0.1/sever/shopcar/shop_userid.php",data)
                        .then((res)=>{
                            this.userDate = res.data
                            this.userId = this.userDate[0].id
                            let arr = 'a'
                            let upId = {"id":arr+=this.userId}
                            console.log(upId)
                            this.$http.post("http://127.0.0.1/sever/shopcar/shop_goods.php",upId)
                            .then((res)=>{
                                this.carList = res.data
                                console.log(this.carList.length)
                            })
                        })
                    }
            }
        },
        methods:{
            //删除商品
                delete_goods(val){
                    console.log(val)
                    let data = {'name':this.names}
                    this.$http.post("http://127.0.0.1/sever/shopcar/shop_userid.php",data)
                        .then((res)=>{
                            this.userDate = res.data
                            this.userId = this.userDate[0].id
                            let arr = 'a'
                            let upId = {"DbId":arr+=this.userId,"GoodsId":val}
                            console.log(upId)
                            this.$http.post("http://127.0.0.1/sever/shopcar/shop_delete.php",upId)
                            .then((res)=>{
                                // this.$router.push('/shopcar')
                                alert("删除成功，请刷新页面!")
                            })
                        })
                },
            //全选
                check_all() {
                    if (this.choiceGoods.length >0) {
                        this.choiceGoods = []
                        
                    } else {
                        this.carList.forEach(item => {
                            this.choiceGoods.push(item)
                            
                        })
                    }
                },
            shopsShow(){
                if(this.carList.length == 0){
                    this.shopShow = true
                }else{
                    this.shopShow = false
                }
            },
            minus(item){
                if(item.num <=0) {
                        item.num = 0
                } else {
                    item.num --
                }
            },
            plus(item){
                item.num++
            }
        },
        computed:{
            //总价
            total_price() {
                let price = 0　　　　　　　　　　　　　　　　　　　　　　　
                this.choiceGoods.forEach(item => {
            //总价 = 价格 * 数量
                    price += Number(item.price) * Number(item.num)
                    this.goodssel = this.choiceGoods
                    console.log(this.goodssel)
                })
                this.$emit('update:orderGoods',this.choiceGoods)
                this.$emit('update:allPrice',price.toFixed(2))
                console.log(this.choiceGoods)
                return price.toFixed(2)
            }
        }
    }
</script>
<style lang="scss" scoped>
.fixTitle{
    width: 370px;
    height: 200px;
    margin: 80px auto;
    padding: 20px 20px;
    font-size: 24px;
    text-align: center;
    background: #e83632;
    border-radius: 10px;
    color: #fff;
    h3{
        width: 430px;
        margin-top: 24px;
        background: #e83632;
        border-radius: 10px;
    }
}
.shops{
    margin: 0 auto;
    width: 1200px;
    padding-bottom: 10px;
    overflow: hidden;
    border: 1px solid #ccc;
    border-top: 0px;
    border-radius: 5px;
    // background: #ccc;
    .carName{
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
        color: #fff;
        background: #e83632;
        border-radius: 5px;
    }
    th,td{
        text-align: center;
    }
    .checkBox{
        width: 20px;
        height: 20px;
    }
    .big{
        position: relative;
        top:5px;
    }
    td{
        position: relative;
        color:#666;
        font-size: 14px;
        border-top:25px dashed #fff;
    }
    .th01{
        width: 60px;
    }
    .th02{
        width: 280px;
    }
    .th03{
        width: 120px;
    }
    .th04{
        width: 300px;
    }
    .th05{
        width: 140px;
    }
    .th06{
        width: 60px;
    }
    .th07{
        width: 120px;
    }
    .th08{
        width: 80px;
    }
    .btn-group{
        width: 40px;
    }
    .td01{
        text-align: left;
        text-indent: 9px;
        line-height: 80px;
    }
    .shopImg{
        position: absolute;
        top: 12px;
        left: 38px;
        width: 80px;
        height: 80px;
        img{
            width: 80px;
            height: 65px;
            border:1px solid #ccc;
            border-radius: 10px;
        }
    }
    .shopName{
        position: absolute;
        top:30px;
        right: 0;
        text-align: left;
        width: 140px;
        height: 40px;
        color:#666;
        font-size: 14px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }
    .shopName:hover{
        color:#e83632;
    }
    .td03{
        margin: 0 auto;
        box-sizing: border-box;
        padding: 30px 10px 0 10px;
        text-align: justify;
        width: 300px;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }
    .td04,.td06{
        color: #e83632;
        font-size: 18px;
        i{
            font-weight: 700;
            font-size: 12px;
            font-style: normal;
            color: #333;
        }
    }
    .td04{
        width: 120px;
        overflow: hidden;
    }
    .td06{
        width: 150px;
        overflow: hidden;
    }
    .col{
        width: 90px;
        .icon-minus,.btn-group,.icon-plus{
            position: absolute;
            top: 29px;
            height: 20px;
            font-size: 14px;
            // float: left;
            border-style: none;
            outline: 0;
            border-radius: 5px;
            text-align: center;
        }
        .icon-minus{
            left:0;
        }
        .btn-group{
            left: 22px;
            border: 1px solid #ccc;
        }
        .icon-plus{
            right: 0;
        }
        .icon-minus,.icon-plus{
            width: 20px;
            height: 20px;
            line-height: 20px;
            border:1px solid #ccc;
            cursor: pointer;
        }
    }
    .btn{
        background: #e83632;
        border: 0px;
        padding: 5px 10px;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
    }
    .next{
        margin: 0 auto;
        margin-top: 20px;
        width: 100px;
        text-align: center;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 18px;
        background: #e83632;
        color: #fff;
        cursor: pointer;
    }
    .allPrice{
        margin-top: 40px;
        font-size: 16px;
        color: #666;
        line-height: 25px;
        .pull-right{
            text-align: center;
            font-size: 18px;
            color:#e83632;
        }
    }
    .tt{
        background: #ccc;
    }
}
</style>

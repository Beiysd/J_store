<template>
    <div class="hed-det">
        <div class="det">
            <div class="de-left">
                <pic-zoom :url="detail.imgurl" :scale="2.5" class="detImg"></pic-zoom>
            </div>
            <div class="de-right">
                <div class="de-title">{{detail.name}}</div>
                <div class="rem"><i>简介：</i>{{detail.tjremake}}</div>
                <div class="de-type"><i>极致追求</i><i>潮流商品</i><i>制造好货</i></div>
                <div class="de-sale"><a>价格：</a><i>RMB</i>  {{detail.price}}</div>
                <div class="icon-truck">  满88元包邮</div>
                <div class="de-shop">
                    <div class="de-num">
                        <div class="icon-minus" @click="minus"></div>
                        <div class="icnum">{{this.num}}</div>
                        <div class="icon-plus" @click="plus"></div>
                    </div>
                    <!-- <div class="de-car" @click="detAll">加入购物车</div> -->
                    <!-- <router-link :to="{name:'shopCar',params:{shopDetail:detail,shopNum:num,shopcarList:shopcarList}}"> -->
                        <button class="de-car" @click="tishi" v-show="!this.names">加入购物车</button>
                        <button class="de-car" @click="addGoods" v-show="this.names">加入购物车</button>
                    <!-- </router-link> -->
                </div>
            </div>
        </div>
        <!-- <div class="alter" v-show="alHid">
            该商品已添加，<br>快去选购其他商品吧！
        </div> -->
    </div>
</template>
<script>
import PicZoom from 'vue-piczoom'
export default {
    props:['dbId','names'],
    data(){
        return{
            name:'detail',
            num:1,
            det:'',
            alHid:false,
            // 包含所有商品的数组，同名商品将会被过滤
            shopcarList:[]
        }
    },
    created(){
        // 生成一个没有同名商品的 数组
        // this._initShopcarList()
    },
    mounted(){
        this.det = this.detail
    },
    components:{
        PicZoom
    },
    methods:{
        minus(){
            this.num--
            if(this.num <= 1){
                this.num=1
            }
        },
        plus(){
            this.num++
        },
        // 反向传值
        // detAll(){
        //     console.log('det'+this.detail)
        //     this.$emit('update:details',this.det)
        //     this.$emit('update:sellNum',this.num)
        // }
        addGoods(){
            let data = {'name':this.names}
            this.$http.post("http://127.0.0.1/sever/shopcar/shop_userid.php",data)
            .then((res)=>{
                this.userDate = res.data
                this.userId = this.userDate[0].id
                let arr = 'a'
                let data = {
                    'id':this.detail.id,
                    'name':this.detail.name,
                    'tjremake':this.detail.tjremake,
                    'imgurl':this.detail.imgurl,
                    'price':this.detail.price,
                    'num':this.num,
                    'dbId':arr+=this.userId
                }
                this.$http.post("http://127.0.0.1/sever/detail/detail_goods.php",data)
                .then((res)=>{
                    console.log(res.data)
                    if(res.data == -1){
                        alert('该商品已存在购物车!')
                    }else{
                        alert('添加购物车成功!')
                    }
                })
            })
        },
        tishi(){
            alert('请登录!')
        }
    },
    computed:{
        detail(){
            return this.$route.params.goodsDetail
        }
    }
}
</script>
<style scoped lang="scss">
.hed-det{
    width: 100%;
    padding: 60px 0px;
    background: #F7F7F7;
}
.det{
    margin: 0 auto;
    padding: 18px;
    width: 1164px;
    height: 400px;
    border: 1px solid #ccc;
    .de-left{
        float: left;
        width: 400px;
        height: 400px;
        background: #F7F7F7;
        overflow: hidden;
        .detImg{
            width: 400px;
            height: 400px;
        }
    }
    .de-right{
        position: relative;
        float: right;
        width: 720px;
        height: 400px;
        border: 1px solid 1px;
        // background: rgb(114, 81, 39);
        .de-title{
            width: 100%;
            height: 52px;
            padding: 10px 4px;
            margin-top: 10px;
            font-size: 18px;
            border-radius: 4px;
            background: #ccc;
        }
        .rem{
            padding: 5px 2px;
            margin-top: 15px;
            text-align: justify;
            font-size: 14px;
            color: #666;
            width: 100%;
            i{
                font-style: normal;
                font-size: 14px;
                font-weight: 700;
                color: #333;
            }
        }
        .de-type{
            padding: 5px 2px;
            margin-top: 15px;
            text-align: justify;
            font-size: 14px;
            i{
                font-style: normal;
                padding: 2px;
                color:#666;
                border-radius: 5px;
                margin-right: 10px;
                background: #ccc;
            }
        }
        .de-sale{
            padding: 5px 2px;
            margin-top: 15px;
            text-align: justify;
            font-size: 20px;
            color: #e83632;
            a{
                font-size: 14px;
                font-weight: 700;
                color: #333;
            }
            i{
                font-style: normal;
                font-size: 16px;
                color: #333;
            }
        }
        .icon-truck{
            width: 130px;
            height: 24px;
            line-height: 24px;
            text-align: center;
            margin-top: 15px;
            font-size: 16px;
            color: #666;
            border: 1px dashed #ccc;
        }
        .de-shop{
            position: absolute;
            width: 100%;
            bottom: 12px;
            // background: #ccc;
            .de-num{
                float: left;
                width: 165px;
                height: 55px;
                background: #ccc;
                .icon-minus,.icnum,.icon-plus{
                    float: left;
                    width: 54px;
                    height: 54px;
                    text-align: center;
                    line-height: 54px;
                    font-size: 16px;
                    cursor: pointer;
                }
                .icnum{
                    background: #fff;
                    width: 55px;
                    height: 55px;
                }
                

            }
            .de-car{
                float: left;
                margin-left: 47px;
                text-align: center;
                width: 154px;
                height: 54px;
                border: none;
                line-height: 54px;
                font-size: 18px;
                color: #fff;
                background: #e83632;
                cursor: pointer;
            }
        }
    }
}
.alter{
    position: fixed;
    padding: 22px 22px;
    transition: ease-in-out 0.2s;
    text-align: center;
    font-size: 16px;
    color:#333;
    font-weight: 700;
    left: 45%;
    top:25%;
    border-radius: 10px;
    background: #FF6A6A;
    border: 1px dashed #ccc;
    z-index: 9999;
}
.mouse-cover-canvas{
    top:109px;
}
</style>



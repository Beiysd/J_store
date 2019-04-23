<template>
    <div>
            <div class="bar_title">
                <li>用户ID</li>
                <li>用户名</li>
                <li>密码</li>
                <li>邮箱</li>
                <li>电话</li>
                <div class="search">
                    <input class="se_inp" type="text" name="search" value="" placeholder="根据用户名查询">
                    <span class="icon-search" @click="search"></span>
                </div>
                <div class="act">操作</div>
                
            </div>
            <div class="next_title" v-for="(item,ind) in this.goodsList" :key="ind">
                <div>
                    <div class="ul" :class="{active:show_search===ind}">
                        <input class="ff" name="f_id" readonly="readonly" type="text"  :value="item.id">
                        <input class="ff" name="f_name" readonly="readonly" type="text"  :value="item.name">
                        <input class="ff" name="f_password" readonly="readonly" type="text"  :value="item.password">
                        <input class="ff" name="f_email" readonly="readonly" type="text"  :value="item.email">
                        <input class="ff" name="f_phone" readonly="readonly" type="text"  :value="item.phone">
                        <button class="xiu" @click="xiu(item,ind)">订单记录</button>
                        <button class="xiu sh" @click="hid(ind)">收起</button>
                    </div>
                    <div class="orde" v-show="nnm === ind">
                        <div class="addre" v-for="(ite,index) in times" :key="index" v-show="ite.time">
                            <div class="add-title">时间: <i class="time">{{ite.time}}</i>
                                <i class="type">
                                    <i @click="times_right(ite.time,index)">显示</i>
                                    <i @click="times_down(ite.time,index)">收起</i>
                                </i>
                            </div>
                            <div style="position:relative;min-height:210px;" v-show="nns===index">
                                <div class="ad_le">
                                    <div><i class="inp-st">省区：</i>  <i class="inp-s">{{addR.prov}}</i></div>
                                    <div><i class="inp-st">城市：</i>  <i class="inp-s">{{addR.city}}</i></div>
                                    <div><i class="inp-st">街道：</i>  <i class="inp-s">{{addR.road}}</i></div>
                                    <div><i class="inp-st">备注： </i>  <i class="inp-s">{{addR.msg}}</i></div>
                                    <div><i class="inp-st">收件人：</i>  <i class="inp-s">{{addR.name}}</i> </div>
                                    <div><i class="inp-st">收件人电话：</i>  <i class="inp-s">{{addR.phone}}</i></div>
                                    <div><i class="inp-st">邮编：</i>  <i class="inp-s"></i>{{addR.post}}</div>
                                </div>
                                <div class="inp-style" v-for="(item,index) in or_go" :key="index">
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
                </div>
            </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            name:'user',
            goodsList:[],
            show_num:'',
            searchNum:'',
            show_search:'',
            searchRes:[],
            dbId:'user',
            numm:'',
            times:[],
            addR:[],
            orderGoods:[],
            ordeAddr:[],
            nnm:'',
            nns:'',
            nnt:'',
            nnts:'',
            upId:''
        }
    },
    watch:{},
    created(){
        this.$nextTick(() => {

            let data = {'dbId':this.dbId}
            this.$http.post("http://127.0.0.1/sever/admin_allgoods/all_goods.php",data)
            .then((res)=>{
                this.goodsList = res.data
            })

            // this.axios.get("http://127.0.0.1/sever/admin_allgoods/all_goods.php")
            // .then(res => {
            //     this.goodsList = res.data
            // })
        })
    },
    mounted(){
        this.$nextTick(() => {})
    },
    methods:{
        xiu(val1,val2){
            this.nnm = val2
            this.nnt = val1
            let arr = 'a'
            let nn = arr+=val1.id
            console.log(nn)
            this.upId = {'id':nn}
            this.$http.post("http://127.0.0.1/sever/shopcar/orde_man.php",this.upId)
            .then((res)=>{
                this.times = res.data
                console.log(this.times)
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
        },
        hid(val){
            this.nnm = -(val+1)
        },
        times_right(val1,val2){
            this.nns = val2
            this.nnts = val1
            this.ordeAddr.findIndex((item,index) => {
                if(item.time == val1){
                    // console.log('false--'+item.id)
                    // console.log('fa--'+index)
                    this.addR = item
                    console.log(this.addR)
                }
            })
        },times_down(val1,val2){
            this.nns = -(val2+1)
        },
        search(){
            console.log('se-')
            this.searchNum = $("input[name='search']").val()
            let data = {'id':this.searchNum,'dbId':this.dbId}
            this.$http.post("http://127.0.0.1/sever/admin_user/user_search.php",data)
            .then((res)=>{
                let num = res.data
                if(num == 0){
                    alert('该用户名不存在!')
                }else{
                    this.searchRes = res.data
                    let ind = this.goodsList.findIndex((item,index) => {
                        if(item.name == this.searchNum){
                            // console.log('false--'+item.id)
                            // console.log('fa--'+index)
                            this.show_search = index
                            alert('查询成功，结果边框为蓝色!')
                        }
                    })
                }
            })
        }
    },
    computed:{
        or_go(){
            if(!this.nnts){
                return ['']
            }
            return this.orderGoods.filter(f => {
                let reg = new RegExp(this.nnts,'img')
              console.log('0')
              return reg.test(f.time)
            })
        },
        //总价
        total_price() {
            let price = 0　　　　　　　　　　　　　　　　　　　　　　　
            this.or_go.forEach(item => {
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
li,input{
    float: left;
    width: 189px;
    text-align: center;
    padding: 5px;
    border-right: 1px solid #fff;
    outline: none;
}
li{
    background: #ccc;
    font-weight: 700;
    padding: 33px 5px;
}
.ul{
    width: 1200px;
    overflow: hidden;
}
.bar_title{
    width: 1200px;
    overflow: hidden;
    .search{
        float: right;
        width: 150px;
        margin-right: 37px;
        .se_inp{
            float: right;
            width: 150px;
            margin-right: 3px;
            outline: none;
            border: none;
            text-align: left;
            padding: 5px;
        }
        .icon-search{
            float: right;
            width: 30px;
            height: 30px;
            margin-top: -30px;
            margin-right: -37px;
            text-align: center;
            line-height: 33px;
            cursor: pointer;
            background: #ccc;
        }
        .icon-search:hover{
            color:red;
        }
    }
    .act,.add{
        float: right;
        width: 200px;
        padding: 21px 0;
        border: none;
        border-top: 1px solid #fff;
        cursor: pointer;
        font-weight: 700;
        background: #ccc;
    }
    .act{
        text-align: center;
        cursor: default;
        font-size: 14px;
    }
    .add:hover{
        color:red;
    }
}
.next_title{
    width: 1200px;
    overflow: hidden;
    ul{
        li:last-child,input:last-child{
            border-right: 0px;
        }
    }
    .ff{
        width: 187px;
        background: #fff;
        color: #111;
    }
    .il{
        width: 187px;
        background: #ccc;
    }
    .xiu,.del,.succ{
        width: 95px;
        padding: 6px 0;
        border: none;
        border-top: 1px solid #fff;
        color:#fff;
        cursor: pointer;
        background: rgb(67, 74, 80);
    }
    .xiu{
        float: left;
    }
    .sh{
        margin-left: 10px;
    }
    .del{
        float: right;
    }
    .succ{
        width: 200px;
    }
    .xiu:hover,.del:hover,.succ:hover{
        color:#EE3B3B;
    }
}
.active{
    border:4px solid blue;
    border-left: none;
}
.search_res{
    position: fixed;
    width: 1200px;
    padding: 10px 0px;
    background: blue;
    top: 205px;
    .icon-cross{
        float: right;
        font-size: 12px;
        margin-right: 5px;
        cursor: pointer;
        color: #ccc;
    }
    .icon-cross:hover{
        color:#111;
    }
}
.orde{
    width: 100%;
    .addre{
        margin-bottom: 10px;
        background: #ccc;
        .ad_le{
            position: absolute;
            margin-left: 15px;
        }
        .inp-style{
            display: inline-block;
            margin-left: 500px;
            margin-bottom: 10px;
            img,.gn,.gp,.gnu,.gt{
                float: left;
                border: 1px solid #fff;
                margin-top: 11px;
                margin-left: 10px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
                overflow: hidden;
            }
            img{
                width: 75px;
                height: 75px;
            }
            .gn{
                width: 150px;
            }
            .gp{
                width: 80px;
            }
            .gnu{
                width: 80px;
            }
            .gt{
                width: 96px;
            }
        }
    }
    .add-title{
        padding: 10px 15px;
        box-sizing: border-box;
        .time{
            font-style: normal;
            font-size: 14px;
            color: rgb(20, 136, 245);
        }
        .type{
            float: right;
            i{
                font-style: normal;
                display: inline-block;
                background: rgb(20, 136, 245);
                border-radius: 6px;
                color: #fff;
                padding: 4px;
                font-size: 14px;
                box-sizing: border-box;
                margin-top: -5px;
                cursor: pointer;
            }
        }
    }

}
.ttP{
    position: absolute;
    bottom: 0;
    left: 15px;
    color: red;
    padding: 10px;
}
.ts{
    left: 260px;
}
</style>

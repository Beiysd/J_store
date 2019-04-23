<template>
    <div class="addre">
        <!-- <h3>address</h3> -->
        <!-- 省，市，县 + 具体地址 -->
        <div class="add-title">收货地址</div>
        <div v-for="(item,index) in addressList" :key="index" v-show="showCar">
            <div>
                <input class="inp-style" type="text" name="prov"  :value="item.prov"  placeholder="请输入正确的省区，港澳台除外">
                <input class="inp-style" type="text" name="city"  :value="item.city" placeholder="请输入正确的城市，港澳台除外">
                <input class="inp-style" type="text" name="road"  :value="item.road" placeholder="请输入正确街道">
                <input class="inp-style" type="text" name="msg"   :value="item.msg" placeholder="请输入备注">
                <input class="inp-style" type="text" name="name"  :value="item.name" placeholder="请输入收件人">
                <input class="inp-style" type="text" name="phone" :value="item.phone" placeholder="请输入收件人手机号">
                <input class="inp-style" type="text" name="post"  :value="item.post" placeholder="请输入邮编">
            </div>
        </div>

        <div v-show="!showCar">
            <input class="inp-style" type="text" name="prov"  v-model="prov" placeholder="请输入正确的省区，港澳台除外">
            <input class="inp-style" type="text" name="city"  v-model="city" placeholder="请输入正确的城市，港澳台除外">
            <input class="inp-style" type="text" name="road"  v-model="road" placeholder="请输入正确街道">
            <input class="inp-style" type="text" name="msg"   v-model="msg" placeholder="请输入备注">
            <input class="inp-style" type="text" name="name"  v-model="name" placeholder="请输入收件人">
            <input class="inp-style" type="text" name="phone" v-model="phone" placeholder="请输入收件人手机号">
            <input class="inp-style" type="text" name="post"  v-model="post" placeholder="请输入邮编">
        </div>

        <div class="inp-st">
            <router-link to="/shopcar">
                <div class="inp-sma01">上一步</div>
            </router-link>
            <!-- <div class="inp-sma02" v-show="!showAdd" @click="creat_s()">创建订单</div> -->
            <router-link :to="{name:'order',params:{selShops:this.goodsSel,toPrice:this.allMoney}}">
                <div class="inp-sma02" @click="creat_sel1()" v-show="showCar">创建订单1</div>
                <div class="inp-sma02" @click="creat_sel2()" v-show="!showCar">创建订单2</div>
            </router-link>
        </div>
    </div>
</template>
<script>
export default {
    props:['names','orderGoods','allPrice'],
    data(){
        return{
            adName:'',
            prov:'',
            city:'',
            road:'',
            msg:'',
            name:'',
            phone:'',
            post:'',
            addressList:[],
            showAdd:false,
            addList:[],
            userDate:'',
            userId:'',
            showCar:'',
            time:''
        }
    },
    created(){
        let date = {'name':this.names}
        this.$http.post("http://127.0.0.1/sever/shopcar/shop_userid.php",date)
        .then((res)=>{
            this.userDate = res.data
            this.userId = this.userDate[0].id
            console.log('aaaaaa'+this.userId)
            let arr = 'a'
            let data = {"dbid":arr+=this.userId}
            console.log(data)
            this.$http.post("http://127.0.0.1/sever/shopcar/shop_add.php",data)
            .then((res)=>{
                this.addressList = res.data
                console.log(this.addressList[0].prov)
            })
        
        })
    },
    mounted(){
        //获取当前日期
        console.log('oogg--'+this.orderGoods)
        console.log('allp--'+this.allPrice)
        let date = new Date();
        let seperator1 = "-";
        let seperator2 = ":";
        let month = date.getMonth() + 1;
        let strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        let currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
                + " " + date.getHours() + seperator2 + date.getMinutes()
                + seperator2 + date.getSeconds();
        
        this.time = currentdate


        // let goods_id = this.goodsSel[0].id
        // console.log('id--'+goods_id)
    },
    watch:{
        post(oldVal,newVal){
            if(!$("input[name='post']")[0].value){
                    this.showAdd = false
                }else{
                    this.showAdd = true
                }
        },
        addressList(oldVal,newVal){
            if(this.addressList.length>0){
                this.showCar = true
            }else{
                this.showCar = false
            }
        }
    },
    methods:{
        creat_s(){
            let f_prov = $("input[name='prov']")[0].value
            let f_city = $("input[name='city']")[0].value
            let f_road = $("input[name='road']")[0].value
            let f_msg = $("input[name='msg']")[0].value
            let f_name = $("input[name='name']")[0].value
            let f_phone = $("input[name='phone']")[0].value
            let f_post = $("input[name='post']")[0].value
            console.log("pp"+f_prov)
            console.log("pp"+f_city)
            console.log("pp"+f_road)
            console.log("pp"+f_msg)
            console.log("pp"+f_name)
            if(!f_prov){
                alert('省区名不得为空!')
            }else if(!f_city){
                alert('城市名不得为空!')
            }else if(!f_msg){
                alert('备注不得为空!')
            }else if(!f_name){
                alert('收件人不得为空!')
            }else if(!f_phone){
                alert('手机号不得为空!')
            }else if(!f_post){
                alert('邮编不得为空!')
            }else{
                this.showAdd = true
            }
        },
        creat_sel1(){
            console.log('prp')
                console.log('creat--'+this.goodsSel)
                let f_prov = $("input[name='prov']")[0].value
                let f_city = $("input[name='city']")[0].value
                let f_road = $("input[name='road']")[0].value
                let f_msg = $("input[name='msg']")[0].value
                let f_name = $("input[name='name']")[0].value
                let f_phone = $("input[name='phone']")[0].value
                let f_post = $("input[name='post']")[0].value
                let arr = 'a'
                let upId = {
                    "dbid":arr+=this.userId,
                    "prov":f_prov,
                    "city":f_city,
                    "road":f_road,
                    "msg":f_msg,
                    "name":f_name,
                    "phone":f_phone,
                    "post":f_post,
                    "time":this.time
                }
                console.log(upId)
                this.$http.post("http://127.0.0.1/sever/shopcar/shop_address.php",upId)
                .then((res)=>{})
                let ar = 'a'
                let data = {
                    "dbid":ar+=this.userId,
                    "arr":this.goodsSel,
                    "time":this.time,
                    "type":'未付款'
                }
                console.log(data)
                this.$http.post("http://127.0.0.1/sever/shopcar/ord_goods.php",data)
                .then((res)=>{
                    
                })
                // this.$http.post("http://127.0.0.1/sever/shopcar/ord_goods.php",this.goodsSel)
                // .then((res)=>{
                    
                // })
        },
        creat_sel2(){
            console.log('prp')
                console.log(this.prov)
                    let arr = 'a'
                    let upId = {
                        "dbid":arr+=this.userId,
                        "prov":this.prov,
                        "city":this.city,
                        "road":this.road,
                        "msg": this.msg,
                        "name":this.name,
                        "phone":this.phone,
                        "post":this.post,
                        "time":this.time
                    }
                    console.log(upId)
                    this.$http.post("http://127.0.0.1/sever/shopcar/shop_address.php",upId)
                    .then((res)=>{})
                    let ar = 'a'
                    let data = {
                        "dbid":ar+=this.userId,
                        "arr":this.goodsSel,
                        "time":this.time,
                        "type":'未付款'
                    }
                    console.log(data)
                    this.$http.post("http://127.0.0.1/sever/shopcar/ord_goods.php",data)
                    .then((res)=>{
                        
                    })
        }
    },
    computed:{
        goodsSel(){
            return this.$route.params.goodsSel
        },
        allMoney(){
            return this.$route.params.allMoney
        }
    }
}
</script>
<style scoped lang="scss">
    .addre{
        margin: 0 auto;
        width: 710px;
        padding: 0px 5px 52px 5px;
        border: 1px solid #ccc;
        border-top: 0px;
        border-radius: 5px;
        .add-title{
            box-sizing: border-box;
            border: 1px solid #ccc;
            padding: 18px;
            font-size: 18px;
            margin-bottom: 20px;
            color: #fff;
            background: #e83632;
            border-radius: 5px;
            width: 710px;
            outline: none;
        }
        .inp-style{
            box-sizing: border-box;
            border: 1px solid #ccc;
            padding: 18px;
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
            border-radius: 5px;
            width: 710px;
            outline: none;
        }
        .inp-st{
            // box-sizing: border-box;
            // border: 1px solid #ccc;
            // padding: 10px 0px;
            // margin-bottom: 20px;
            // color: #333;
            /* background: #e83632; */
            // border-radius: 5px;
            // width: 600px;
            // outline: none;
            .inp-sma01,.inp-sma02{
                width: 100px;
                padding: 10px 15px;
                background: #e83632;
                border-radius: 5px;
                text-align: center;
                color: #fff;
                cursor: pointer;
            }
            .inp-sma01{
                float: left;
            }
            .inp-sma02{
                float: right;
            }
        }
    }
</style>



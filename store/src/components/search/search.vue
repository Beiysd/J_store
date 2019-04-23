<template>
    <div>
        <div class="middles-bar">
  			<div class="log">
  				<img :src="home.logo" alt="">
  			</div>
  			<div class="title">搜索页</div>
  			<div class="search">
  				<input class="search-inp" type="text" v-model="searchStr">
  				<button class="btn">搜索</button>
  			</div>
  			<!-- <div class="shopCar">
  				我的购物车<i class="icon-cart1"></i>
  			</div> -->
				<router-link to="/shopcar">
					<div class="shopCar">
  					我的购物车<i class="icon-cart1"></i>
  				</div>
				</router-link>
  			<div class="qrcode" @mouseenter="onMouseOver" @mouseleave="onMouseOut">
  				<i class="qrcode-icon"></i>
  				扫码享优惠
  			</div>
  			<div class="hidden-qrcode" v-show="see">
  				<img src="https://qrimg.jd.com/https://pro.m.jd.com/mall/active/48v7Xzb3FfKt6mKgMaS9EoHrvieE/index.html-100-1-4-0.png" alt="">
  			</div>
  		</div>
        <div class="search-goods">
            <ul>
                <!-- 搜索页数据 -->
                <li v-show="searchStr" class="list" v-for="(item,index) in searchGoods" :key="index">
                    <router-link :to="{name:'Detail',params:{goodsDetail:searchGoods[index]}}">
                        <img :src="item.imgurl" class="machineImg" alt="">
                        <p class="machineSale"><i>RMB</i>  {{item.price}}</p>
                        <p class="showTitle">{{item.name}}</p>
                    </router-link>
                </li>
                <!-- home页转来数据 -->
                 <li v-show="searchKey" class="list" v-for="(item,index) in searchGoodsKey" :key="index">
                    <router-link :to="{name:'Detail',params:{goodsDetail:searchGoodsKey[index]}}">
                        <img :src="item.imgurl" class="machineImg" alt="">
                        <p class="machineSale"><i>RMB</i>  {{item.price}}</p>
                        <p class="showTitle">{{item.name}}</p>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props:['home','allmes'],
    data(){
        return{
            name:'search',
            see:false,
            searchStr:'',
            godHid:true,
            goods:[]
        }
    },
    created(){
		this.axios.get("http://127.0.0.1/sever/all_goods.php")
		.then(res => {
			  this.goods=res.data
		  })
		.catch(error => {
			console.log(error);
			alert('网络错误，不可访问');
		})
	},
    mounted(){
        this.$nextTick(() => {
            // if(!this.searchStr){
            //     $('.list:first').addClass("hidden")
            // }
        })
    },
    watch:{
        searchStr(oldVal,newVal){
            if(oldVal != newVal){
                // console.log('123')
                this.searchMod()
            }
            if(!newVal || !oldVal){
                this.godHid = false
                $('.list').addClass("hidden")
            }
        }
    },
    methods:{
        onMouseOver(){
            this.see = true
        },
        onMouseOut(){
            this.see = false
        },
        searchMod(){
            console.log(this.searchStr)
        }
    },
    computed:{
        searchKey(){
            return this.$route.params.searchKey
        },
        searchGoods(){
            let allGoods = this.goods
            if(!this.searchStr){
                return ['']
            }
            return allGoods.filter(f => {
                let reg = new RegExp(this.searchStr,'img')
              console.log('0')
              return reg.test(f.name)
            })
        },
        searchGoodsKey(){
            let allsGoods = this.goods
            if(!this.searchKey){
                return ['']
            }
            return allsGoods.filter(f => {
                let reg = new RegExp(this.searchKey,'img')
              console.log('0')
              return reg.test(f.name)
            })
        },
        pageTableData_Search(){
                let newList=[];
                for(let i=0;i<this.pages;i++){
	                let sonList=[];
	                sonList=this.shops.slice(i*10,i*10+10);//20为每页设置数量
					console.log('sonlist'+sonList)
	                newList.push(sonList)
                }
                return newList[this.currentPage-1]
        },
        pageTableData_Key(){
                let newList=[];
                for(let i=0;i<this.pages;i++){
                    let sonList=[];
                    sonList=this.shops.slice(i*10,i*10+10);//20为每页设置数量
                    console.log('sonlist'+sonList)
                    newList.push(sonList)
                }
                return newList[this.currentPage-1]
        }
    }
}
</script>
<style scoped lang="scss">
.middles-bar{
    position:relative;
    box-sizing:border-box;
    padding:22px 0px;
    margin:0 auto;
    width:1200px;
    .log{
        display:inline-block;
    }
    .title{
        position:absolute;
        top:36px;
        left:220px;
        cursor:default;
        font-size:20px;
        font-weight:400;
        color:#666;
    }
    .search{
        position:absolute;
        width:455px;
        height:36px;
        top:30px;
        left:420px;
        overflow:hidden;
        .search-inp{
            float:left;
            width:365px;
            height:24px;
            line-height:24px;
            padding:4px;
            color:#999;
            margin-bottom:4px;
            border-width:2px 0px 2px 2px;
            border-color:#dd4545;
            border-style:solid;
            outline:0;
            font-size:12px;
        }
        .btn{
            float:left;
            width:80px;
            height:36px;
            outline: none;
            border:0;
            border-radius:0;
            color:#fff;
            font-size:16px;
            cursor:pointer;
            background:#dd4545;
        }
    }
    .shopCar{
        position:absolute;
        top:30px;
        left:912px;
        width:110px;
        height:34px;
        font-size:13px;
        color:#f30213;
        line-height:34px;
        padding:0px 0px 0px 19px;
        background:#f9f9f9;
        border:1px solid #dfdfdf;
        cursor:pointer;
        .icon-cart1{
            float:right;
            font-size:16px;
            margin-right:20px;
            margin-top:8px;
        }
    }
    .qrcode{
        position:absolute;
        top:30px;
        right:0px;
        width:118px;
        height:34px;
        font-size:13px;
        color:#999;
        line-height:34px;
        border:1px solid #dfdfdf;
        background:#f9f9f9;
        cursor:pointer;
        .qrcode-icon{
            float:left;
            width:25px;
            height:25px;
            margin:4px 10px 5px 8px;
            background:url('https://misc.360buyimg.com/channel/lib/1.2.0/widget/qrcode/i/qr_icon.png');
            background-size:cover;
        }
    }
    .hidden-qrcode{
        position:absolute;
        top:65px;
        right:0px;
        width:100px;
        height:100px;
        padding:9px;
        border:1px solid #dfdfdf;
        background:#fff;
        z-index:999;
    }
    .search-tail{
        margin-left:420px;
        width:455px;
        height:20px;
        line-height:20px;
        overflow:hidden;
        li{
            float:left;
            line-height:20px;
            font-size:12px;
            color:#999;
            margin-right:10px;
            cursor:pointer;
        }
        li:first-child{
            color:red;
        }
        li:hover{
            color:red;
        }
    }
}
.hidden{
    display: none;
}
.search-goods{
    box-sizing: border-box;
    margin: 0 auto;
    width: 1110px;
    height: 100%;
    padding: 70px 0px;
    overflow: hidden;
    .list{
        width: 202px;
        float: left;
        padding: 35px 10px;
        text-align: center;
        background-color: #fff;
        box-shadow: 3px 2px 30px rgba(0,0,0,.1);
		cursor: pointer;
        .machineImg{
            width: 150px;
            height: 180px;
        }
        .machineImg:hover{
            transition: ease-in-out 0.2s;
            transform: scale(1.15);
        }
        .machineSale{
            margin-top: 20px;
            padding: 5px;
            text-align: center;
            font-size: 20px;
            color: #e83632;
            i{
                font-size: 16px;
                font-style: normal;
                color: #333;
            }
        }
        .showTitle{
            padding: 10px 10px 5px 10px;
            font-size: 16px;
            color: #666;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    }
}
</style>


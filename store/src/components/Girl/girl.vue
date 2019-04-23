<template>
  <div>
		<!-- 头部 -->
  	<div class="head-bar">
  		<div class="headImg" v-show="headImg">
  			<img :src="home.headImg" alt="">
  			<i @click="hiddHeadImg"></i>
  		</div>
  		<div class="middles-bar">
  			<div class="log">
  				<img :src="home.logo" alt="">
  			</div>
  			<div class="title">女装馆</div>
  			<div class="search">
  				<input class="search-inp" type="text" v-model="homeStr" :placeholder="home.hotSearch">
					<router-link :to="{name:'search',params:{searchKey:homeStr}}">
						<button class="btn">搜索</button>
					</router-link>
  			</div>
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
  			<div class="search-tail">
  				<li v-for="(item,index) in hotList" :key="index">{{item.hottitle}}</li>
  			</div>
  		</div>
  		<div class="title-bar">
  			<router-link to="/">
					<li class="first-li" @mouseenter="leftMouseOver()" @mouseleave="leftMouseOut()">全部分类</li>
				</router-link>
				<router-link to="/homeele">
					<li >家电馆</li>
				</router-link>
				<router-link to="/computer">
					<li>电脑馆</li>
				</router-link>
				<router-link to="/boy">
					<li>男装馆</li>
				</router-link>
				<router-link to="/girl">
					<li style="background: #d13030;
            color:#fff;">女装馆</li>
				</router-link>
				<router-link to="/phone">
					<li>3C数码馆</li>
				</router-link>
  		</div>
  	</div>
		<div>
			<!-- 轮播+侧栏 -->
			<div class="neck-bar">
				<div class="middle">
					<div class="left-bar" @mouseenter="leftMouseOver()" @mouseleave="leftMouseOut()" v-show="celan">
						<i class="left-li" v-for="(item,index) in goodsType" :key="index">
							<!-- <li> -->
							<router-link :to="{name:'search',params:{searchKey:item.typesname}}">
								{{item.typesname}}
							</router-link>
							/
						</i>
						
					</div>
					<div class="midd-bar">
						<div class="swiper-container container1">
									<div class="swiper-wrapper">
											<div class="swiper-slide" v-for="(item,index) in rotationImg" :key="index">
													<img :src="item.imgurl" alt="">
											</div>
									</div>
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
									<div class="swiper-pagination"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 商品栏 -->
			<div class="goods">
				<!-- goodsMachine -->
				<div class="goodsMachine">
					<li v-for="(item,index) in pageTableData" :key="index">
						<router-link :to="{name:'Detail',params:{goodsDetail:pageTableData[index]}}">
							<img :src="item.imgurl" class="machineImg" alt="">
							<p class="machineSale"><i>RMB</i>  {{item.price}}</p>
							<p class="showTitle">{{item.name}}</p>
						</router-link>
					</li>
				</div>
            </div>
            <div class="page">
                <el-pagination
                    background
                    :current-page.sync="currentPage"
                    :page-size="10"
                    layout="prev, pager, next"
                    :total="listNum">
                </el-pagination>
            </div>
		</div>
  </div>
</template>
<script>
import Swiper from 'swiper'
    export default{
    	props:["home"],
        //data为工厂模式
        data(){
            return {
                name: 'girl',
                headImg:true,
                homeStr:'',
                see:false,
                animation:true,
                celan:false,
                currentPage:1,
        				listNum:1,
								girlLunbo:[],
								girlGoods:[],
								goodsType:[],
								girlSwiper:''
          	}
				},
				created(){
					//轮播信息
					this.$nextTick(() => {
						this.axios.get("http://127.0.0.1/sever/girl/girl_lunbo.php")
					.then(res => {
							this.girlLunbo=res.data;
							this.$nextTick(() => {
									this.initSwiper();//下一个UI帧再初始化，保证了v-for已经完成循环
							})
						})
					.catch(error => {
						console.log(error);
						alert('网络错误girl01，不可访问');
					})

					//goods_type信息
						this.axios.get("http://127.0.0.1/sever/home/goods_type.php")
						.then(res => {
								this.goodsType=res.data;
							})
						.catch(error => {
							console.log(error);
							alert('网络错误girl02，不可访问');
						})

					//goods信息
						this.axios.get("http://127.0.0.1/sever/girl/girl_goods.php")
						.then(res => {
								this.girlGoods=res.data;
								this.listNum = this.girlGoods.length
								console.log('cahng'+this.listNum)
							})
						.catch(error => {
							console.log(error);
							alert('网络错误girl03，不可访问');
						})
					})
				},
        mounted(){
          this.$nextTick(() => {
            this.girlSwiper.el.onmouseover = function () { //鼠标放上暂停轮播
              this.girlSwiper.autoplay.stop();
            },
						this.girlSwiper.el.onmouseleave = function () {
							this.girlSwiper.autoplay.start();
						}
          })
        },
        watch:{
            homeStr(oldVal,newVal){
                if(oldVal != newVal){
                    this.searchVal()
                }
            }
        },
        methods:{
        	hiddHeadImg(){
        		this.headImg = false
        	},
        	onMouseOver(){
        		this.see = true
        	},
        	onMouseOut(){
        		this.see = false
        	},
        	leftMouseOver(){
					console.log('zhen')
        		this.celan = true
					},
					leftMouseOut(){
							console.log('jia')
							this.celan = false
					},
					showTitle(val){
							this.titleNum = val
							console.log(val)
					},
					hiddleTitle(){
							this.titleNum = -1
					},
				
					searchVal(){
							// console.log(this.homeStr)
							if(!this.homeStr){
											console.log(false)
											this.search = true
							}else{
											console.log(true)
											this.search = false
							}
					},
					initSwiper(){
						this.girlSwiper = new Swiper('.container1', {
              loop: true,
              autoplay: {
                delay: 2500,
                stopOnLastSlide: false,
                disableOnInteraction: false
              },
              // 如果需要分页器
              pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
              },
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
              }
            });
					}
        },
        computed:{
        	hotList(){
        		let hotResult = ''
        		hotResult = this.home.hotList
        		return hotResult
        	},
        	topTitle(){
        		let topResult = ''
        		topResult = this.home.topTitle
        		return topResult
        	},
        	leftTitle(){
        		let leftResult = ''
        		leftResult = this.home.hotType
        		return leftResult
        	},
					rotationImg(){
							let rotationResult = ''
							rotationResult = this.girlLunbo
							return rotationResult
					},
          // flashDeals(){
          //     return this.home.flashDeals
					// },
// 商品栏
            goodsMachine(){
                return this.home.goods.gmachine
            },
            pageTableData(){
                let pages=Math.ceil(this.girlGoods.length/10);//5为每页设置数量
                let newList=[];
                for(let i=0;i<pages;i++){
                let sonList=[];
                sonList=this.girlGoods.slice(i*10,i*10+10);//5为每页设置数量
                newList.push(sonList)
                }
                return newList[this.currentPage-1]
        	}
        }
    }
</script>
<style lang="scss" scoped>
.head-bar{
	width:100%;
	background:#fff;
	.headImg{
		position:relative;
		margin:0 auto;
		width:1200px;
		img{
			width:1200px;
		}
		i{
			position:absolute;
			width:20px;
			height:20px;
			top:8px;
			right:8px;
			font-style:normal;
			background:url('https://misc.360buyimg.com/channel/jiadian/2.0.2/home/images/sprite_jiadian_index.png') no-repeat;
			cursor:pointer;
		}
	}
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
	.title-bar{
		margin:0 auto;
		width:1200px;
		li{
			float:left;
			padding:5px;
			box-sizing: border-box;
			font-size: 18px;
			// flex:1;
			width: 200px;
			color:#333;
			text-align:center;
			cursor:pointer;
		}
		li:hover{
			color:#fff;
			background:#d13030;
		}
		.first-li{
			text-align:left;
			text-indent:10px;
			color:#fff;
			width: 200px;
			border-right:1px solid #fff;
			background:#d13030;
		}
	}
}
.neck-bar{
	width:100%;
	height:460px;
	min-width:1200px;
  /*background:#e3e4e5;*/
	overflow:hidden;
	.middle{
		position:relative;
		margin:0 auto;
		width:1200px;
		height:460px;
		overflow:hidden;
		.left-bar{
			position: absolute;
			top: 0;
			left: 0;
			width:198px;
			height:459px;
			border-left: 1px solid #ccc;
			border-bottom: 1px solid #ccc;
			background:#fff;
			z-index: 9999;
			cursor:pointer;
			.left-li{
			font-style: normal;
			padding: 0 4px;
			a{
				color:#333;
			}
			}
			.left-li a:hover{
				color:red;
			}
		}
		.hiddle-bar{
			position:absolute;
			box-sizing:border-box;
			top:0;
			left:200px;
			padding:15px;
			width:1000px;
			height:460px;
			background:#fff;
            border:1px solid #ccc;
            z-index:999;
			.hiddleTop-li{
				padding:8px 4px;
				font-size:12px;
				background:#fff;
				.hiddleTop{
					display:inline-block;
					width:60px;
					text-align:right;
					font-weight:700;
					color:#666;
					cursor:default;
				}
				.icon-ctrl{
					display:inline-block;
					transform:rotate(90deg);
					font-weight:700;
					margin-top:1px;
					margin-right:8px;
				}
				.hiddleEnd{
					padding:0px 8px;
					font-size:12px;
					color:#666;
					border-left:1px solid #ccc;
					cursor:pointer;
				}
				.hiddleEnd:hover{
					color:red;
				}
			}
		}
		.midd-bar{
			/*float:left;*/
			position: absolute;
			// left: 200px;
			top:0px;
			width:1200px;
			height:460px;
			background:#fff;
			overflow:hidden;
			img{
					width:1200px;
					height:460px;
			}
			.swiper-pagination-bullet{
					width: 12px;
					height: 12px;
			}
		}
	}
}
.goods{
	width: 100%;
	background: #fff;
	.goodsMachine{
		margin: 60px auto;
		width: 1110px;
		h3{
			clear: both;//清除浮动
			box-sizing:border-box;
			background-color: #fff;
			padding: 35px 0px 10px 5px;
			font-size: 22px;
			font-weight: 200;
			i{
				margin-top: 10px;
				font-style: normal;
				float: right;
				font-size: 12px;
				color: #999;
			}
		}
		li{
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
}
.page{
    clear: both;
    text-align: center;
    padding: 50px 0px;
}
</style>

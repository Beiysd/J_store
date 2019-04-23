<script src="../../../../1219-vue-test/dem03/src/router/index.js"></script>
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
  			<div class="title">{{home.typesName}}</div>
  			<div class="search">
  				<input class="search-inp" type="text" v-model="homeStr" :placeholder="home.hotSearch">
  				<!-- <button class="btn">搜索</button> -->
					<router-link :to="{name:'search',params:{searchKey:homeStr}}">
						<button class="btn">搜索</button>
					</router-link>
  			</div>
  			<div class="shopCar" @click="shopcar">
  				我的购物车<i class="icon-cart1"></i>
  			</div>
				<!-- <router-link to="/shopcar">
					<div class="shopCar">
  					我的购物车<i class="icon-cart1"></i>
  				</div>
				</router-link> -->
  			<div class="qrcode" @mouseenter="onMouseOver" @mouseleave="onMouseOut">
  				<i class="qrcode-icon"></i>
						<!-- <router-link to="/test"> -->
							扫码享优惠
						<!-- </router-link> -->
  			</div>
  			<div class="hidden-qrcode" v-show="see">
  				<img src="https://qrimg.jd.com/https://pro.m.jd.com/mall/active/48v7Xzb3FfKt6mKgMaS9EoHrvieE/index.html-100-1-4-0.png" alt="">
  			</div>
  			<div class="search-tail">
  				<li v-for="(item,index) in hotList" :key="index">{{item.hottitle}}</li>
  			</div>
  		</div>
  		<div class="title-bar">
  			<li class="first-li" @mouseenter="leftMouseOver()" @mouseleave="leftMouseOut()">全部分类</li>
				<router-link to="/homeele">
					<li>家电馆</li>
				</router-link>
				<router-link to="/computer">
					<li>电脑馆</li>
				</router-link>
				<router-link to="/boy">
					<li>男装馆</li>
				</router-link>
				<router-link to="/girl">
					<li>女装馆</li>
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
							<router-link :to="{name:'search',params:{searchKey:item.typesname}}">
								{{item.typesname}}
							</router-link> /
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
			<div class="one-title">
				数码大 <i class="blod">New</i> 货 <i class="sm">这里只玩新的</i>
			</div>
			<!-- 风琴效果 -->
			<div class="middle-bar">
				<ul class="win">
					<!-- <li class="winLi" v-for="(item,index) in winds" :key="index">
							<a>
								<div class="p1 p1p">{{item.name}}</div>
								<div class="p2 p2p">{{item.tjremake}}</div>
								<div class="go gg">{{item.go}}</div>
								<div class="img"><img :src="item.imgurl" alt="加载失败"/></div>
							</a>
					</li> -->
					<li class="winLi">
						<a>
							<div class="p1 p1p">{{name00}}</div>
							<div class="p2 p2p">{{tjremake00}}</div>
							<div class="go gg">{{go00}}</div>
							<div class="img"><img :src="imgurl00" alt="加载失败"/></div>
						</a>
					</li>
					<li class="winLi">
						<a>
							<div class="p1 p1p">{{this.name01}}</div>
							<div class="p2 p2p">{{this.tjremake01}}</div>
							<div class="go gg">{{this.go01}}</div>
							<div class="img"><img :src="this.imgurl01" alt="加载失败"/></div>
						</a>
					</li>
					<li class="winLi">
						<a>
							<div class="p1 p1p">{{this.name02}}</div>
							<div class="p2 p2p">{{this.tjremake02}}</div>
							<div class="go gg">{{this.go02}}</div>
							<div class="img"><img :src="this.imgurl02" alt="加载失败"/></div>
						</a>
					</li>
					<li class="winLi">
						<a>
							<div class="p1 p1p">{{name03}}</div>
							<div class="p2 p2p">{{tjremake03}}</div>
							<div class="go gg">{{go03}}</div>
							<div class="img"><img :src="imgurl03" alt="加载失败"/></div>
						</a>
					</li>
					<li class="winLi">
						<a>
							<div class="p1 p1p">{{name04}}</div>
							<div class="p2 p2p">{{tjremake04}}</div>
							<div class="go gg">{{go04}}</div>
							<div class="img"><img :src="imgurl04" alt="加载失败"/></div>
						</a>
					</li>
					
				</ul>
				<!-- <ul class="win">
					<li class="winLi">
						<a href="" target="_blank">
							<div class="p1 p1p">NBA球</div>
							<div class="p2 p2p">314直降300元</div>
							<div class="go gg">GO</div>
							<div class="img"><img class="imgg" src="https://img14.360buyimg.com/cms/jfs/t1/19673/12/9638/80904/5c833045E741539ad/ac31562e49bf5a20.png!q80.webp" alt="加载失败"/></div>
						</a>
					</li>
					<li class="winLi">
						<a href="">
							<div class="p1">腾讯机</div>
							<div class="p2">王者荣耀孙香标准版</div>
							<div class="go">GO</div>
							<div class="img"><img src="https://img14.360buyimg.com/cms/jfs/t1/26488/33/861/67493/5c0dccf3Ec4f3de17/a929470b55fd6466.png!q80.webp" alt="加载失败"/></div>
						</a>
					</li>
					<li class="winLi">
						<a href="">
							<div class="p1">B&O PLAYoplay E8</div>
							<div class="p2">314直元</div>
							<div class="go">GO</div>
							<div class="img"><img src="https://img11.360buyimg.com/cms/jfs/t1/20743/6/9986/48753/5c8331d2E8074f862/4fde8c42ad6c9d87.png!q80.webp" alt="加载失败"/></div>
						</a>
					</li>
					<li class="winLi">
						<a href="">
							<div class="p1">小天手表</div>
							<div class="p2">套装时优惠</div>
							<div class="go">GO</div>
							<div class="img"><img src="https://img13.360buyimg.com/cms/jfs/t1/7442/17/15097/107349/5c6ba8e0Ef3910b0e/f0feb9a5bc9200b3.png!q80.webp"/></div>
						</a>
					</li>
					<li class="winLi">
						<a href="">
							<div class="p1">索尼-1000XM3</div>
							<div class="p2">高无线蓝牙降噪耳机</div>
							<div class="go">GO</div>
							<div class="img"><img src="https://img10.360buyimg.com/cms/jfs/t1/28166/19/9876/74064/5c832fa1Ecc94aaa8/91f7490fc51dc629.png!q80.webp" alt="加载失败"/></div>
						</a>
					</li>
				</ul> -->
			</div>
			<!-- 商品栏 -->
			<div class="goods">
				<!-- goodsMachine -->
				<div class="goodsMachine">
					<h3 id="homele">
						家电区域 
						<router-link to="/homeele">
							<i>更多>></i>
						</router-link>
					</h3>
					<li v-for="(item,index) in homEle" :key="index">
						<router-link :to="{name:'Detail',params:{goodsDetail:homEle[index]}}">
							<img :src="item.imgurl" class="machineImg" alt="">
							<p class="machineSale"><i>RMB</i>  {{item.price}}</p>
							<p class="showTitle">{{item.name}}</p>
						</router-link>
					</li>
				</div>
				<!-- goodsComputer -->
				<div class="goodsMachine">
					<h3 id="computer">
						电脑区域 
						<router-link to="/computer">
							<i>更多>></i>
						</router-link>
					</h3>
					<li v-for="(item,index) in homeComp" :key="index">
						<router-link :to="{name:'Detail',params:{goodsDetail:homeComp[index]}}">
							<img :src="item.imgurl" class="machineImg" alt="">
							<p class="machineSale"><i>RMB</i>  {{item.price}}</p>
							<p class="showTitle">{{item.name}}</p>
						</router-link>
					</li>
				</div>
					<!-- goodsPhone -->
				<div class="goodsMachine">
					<h3 id="phone">
						手机区域 
						<router-link to="/phone">
							<i>更多>></i>
						</router-link>
					</h3>
					<li v-for="(item,index) in homePhone" :key="index">
						<router-link :to="{name:'Detail',params:{goodsDetail:homePhone[index]}}">
							<img :src="item.imgurl" class="machineImg" alt="">
							<p class="machineSale"><i>RMB</i>  {{item.price}}</p>
							<p class="showTitle">{{item.name}}</p>
						</router-link>
					</li>
				</div>
				<!-- goodsBoy -->
				<div class="goodsMachine">
					<h3 id="boy">
						男装区域 
						<router-link to="/boy">
							<i>更多>></i>
						</router-link>
					</h3>
					<li v-for="(item,index) in homeBoy" :key="index">
						<router-link :to="{name:'Detail',params:{goodsDetail:homeBoy[index]}}">
							<img :src="item.imgurl" class="machineImg" alt="">
							<p class="machineSale"><i>RMB</i>  {{item.price}}</p>
							<p class="showTitle">{{item.name}}</p>
						</router-link>
					</li>
				</div>
				<!-- goodsGirl -->
				<div class="goodsMachine">
					<h3 id="girl">
						女装区域 
						<router-link to="/girl">
							<i>更多>></i>
						</router-link>
					</h3>
					<li v-for="(item,index) in homeGirl" :key="index">
						<router-link :to="{name:'Detail',params:{goodsDetail:homeGirl[index]}}">
							<img :src="item.imgurl" class="machineImg" alt="">
							<p class="machineSale"><i>RMB</i>  {{item.price}}</p>
							<p class="showTitle">{{item.name}}</p>
						</router-link>
					</li>
				</div>
			</div>
			<!-- 右侧跳转栏 -->
			<div class="fix">
				<li v-for="(item,index) in title" :key="index" @click="jump(index)">{{item.title}}</li>
				<li @click="top" class="icon-shift"></li>
			</div>
		</div>
		<!-- 搜索页面 -->
		<div class="search">

		</div>
  </div>
</template>
<script>
import {setCookie,getCookie,delCookie} from '../assets/js/cookie.js'
import Swiper from 'swiper'
import {window} from '../assets/js/win.js'
    export default{
    	props:["home"],
        //data为工厂模式
        data(){
            return {
                name: 'Home',
                headImg:true,
								homeStr:'',
								swiper:'',
                see:false,
								animation:true,
								celan:false,
								winds:[],
								name00:'',
								tjremake00:'',
								go00:'',
								imgurl00:'',
								name01:'',
								tjremake01:'',
								go01:'',
								imgurl01:'',
								name02:'',
								tjremake02:'',
								go02:'',
								imgurl02:'',
								name03:'',
								tjremake03:'',
								go03:'',
								imgurl03:'',
								name04:'',
								tjremake04:'',
								go04:'',
								imgurl04:'',
								homeLunbo:[],
								goodsType:[],
								homEle:[],
								homeComp:[],
								homePhone:[],
								homeBoy:[],
								homeGirl:[]
            }
				},
				created(){
					this.$nextTick(() => {
						//风琴信息
						this.axios.get("http://127.0.0.1/sever/home/home_window.php")
						.then(res => {
								this.winds=res.data
										this.name00 = this.winds[0].name
										this.tjremake00 = this.winds[0].tjremake
										this.go00 = this.winds[0].go
										this.imgurl00 = this.winds[0].imgurl 

										this.name01 = this.winds[1].name
										this.tjremake01 = this.winds[1].tjremake
										this.go01 = this.winds[1].go
										this.imgurl01 = this.winds[1].imgurl 

										this.name02 = this.winds[2].name
										this.tjremake02 = this.winds[2].tjremake
										this.go02 = this.winds[2].go
										this.imgurl02 = this.winds[2].imgurl 

										this.name03 = this.winds[3].name
										this.tjremake03 = this.winds[3].tjremake
										this.go03 = this.winds[3].go
										this.imgurl03 = this.winds[3].imgurl 

										this.name04 = this.winds[4].name
										this.tjremake04 = this.winds[4].tjremake
										this.go04 = this.winds[4].go
										this.imgurl04 = this.winds[4].imgurl 
							})
							.catch(error => {
								console.log(error);
								alert('网络错误wind，不可访问');
							})
						//轮播信息
						this.axios.get("http://127.0.0.1/sever/home/home_lunbo.php")
						.then(res => {
								this.homeLunbo=res.data;
								this.$nextTick(() => {
									this.initSwiper();//下一个UI帧再初始化，保证了v-for已经完成循环
								})
							})
						.catch(error => {
							console.log(error);
							alert('网络错误homlun，不可访问');
						})

						//goods_type信息
						this.axios.get("http://127.0.0.1/sever/home/goods_type.php")
						.then(res => {
								this.goodsType=res.data;
							})
						.catch(error => {
							console.log(error);
							alert('网络错误goods-type，不可访问');
						})

						//homele信息
						this.axios.get("http://127.0.0.1/sever/home/home_homele.php")
						.then(res => {
								this.homEle=res.data;
							})
						.catch(error => {
							console.log(error);
							alert('网络错误home-homele，不可访问');
						})

						//computer信息
						this.axios.get("http://127.0.0.1/sever/home/home_computer.php")
						.then(res => {
								this.homeComp=res.data;
							})
						.catch(error => {
							console.log(error);
							alert('网络错误home-computer，不可访问');
						})

						//phone信息
						this.axios.get("http://127.0.0.1/sever/home/home_phone.php")
						.then(res => {
								this.homePhone=res.data;
							})
						.catch(error => {
							console.log(error);
							alert('网络错误home-phone，不可访问');
						})

						//boy信息
						this.axios.get("http://127.0.0.1/sever/home/home_boy.php")
						.then(res => {
								this.homeBoy=res.data;
							})
						.catch(error => {
							console.log(error);
							alert('网络错误home-boy，不可访问');
						})

						//girl信息
						this.axios.get("http://127.0.0.1/sever/home/home_girl.php")
						.then(res => {
								this.homeGirl=res.data;
							})
						.catch(error => {
							console.log(error);
							alert('网络错误home-girl，不可访问');
						})
					})
				},
        mounted(){
    	  	window();
          this.$nextTick(() => {
            
            this.swiper.el.onmouseover = function () { //鼠标放上暂停轮播
              this.swiper.autoplay.stop();
            },
						this.swiper.el.onmouseleave = function () {
							this.swiper.autoplay.start();
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
					shopcar(){
						let uname = getCookie('username')
						/*如果cookie不存在，则跳转到登录页*/
						if(uname == ""){
								alert('请登录!')
						}else{
							this.$router.push('/shopcar')
						}
					},
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
          wind:function(){
        	  windown();
					},
					initSwiper(){
						this.swiper = new Swiper('.container1', {
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
					},
					top(){
						//500毫秒返回顶部
					$('html').animate( {scrollTop: 0}, 500);
					},
					jump(index){
						if(index==0){
							$('html').animate({ scrollTop: $("#homele").offset().top}, 500 );
						}else if(index==1){
							$('html').animate({ scrollTop: $("#computer").offset().top}, 500 );
						}else if(index==2){
							$('html').animate({ scrollTop: $("#phone").offset().top}, 500 );
						}else if(index==3){
							$('html').animate({ scrollTop: $("#boy").offset().top}, 500 );
						}else if(index==4){
							$('html').animate({ scrollTop: $("#girl").offset().top}, 500 );
						}
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
        	// leftTitle(){
        	// 	let leftResult = ''
        	// 	leftResult = this.home.hotType
        	// 	return leftResult
        	// },
          rotationImg(){
            let rotationResult = ''
            rotationResult = this.homeLunbo
            return rotationResult
          },
          // flashDeals(){
          //     return this.home.flashDeals
					// },
// 商品栏
					// goodsMachine(){
					// 	return this.home.goods.gmachine
					// },
					// goodsComputer(){
					// 	return this.home.goods.gcomputer
					// },
					// goodsBoy(){
					// 	return this.home.goods.gboy
					// },
					// goodsGirl(){
					// 	return this.home.goods.ggirl
					// },
					// goodsPhone(){
					// 	return this.home.goods.gphone
					// },
					title(){
						return this.home.goods.title
					}
        }
    }
</script>
<style lang="scss">
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
				// line-height:24px;
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
			padding: 0 6px;
			color:#666;
			a{
				color:#666;
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
.one-title{
  margin: 0 auto;
  width: 1200px;
  padding: 25px 0 20px 0;
  font-size: 24px;
  font-weight: 300;
  -webkit-font-smoothing: antialiased;
  font-style: normal;
  color: #333;
  .blod{
    font-weight: 500;
  }
  .sm{
    font-style: normal;
    font-size: 14px;
    color: #666;
  }
}
.middle-bar{
  .win{
    display: block;
    margin: 0 auto;
    width: 1200px;
    height: 300px;
    .winLi{
      transition:ease-out  1s;
      float: left;
      position: relative;
      width: 200px;
      height: 300px;
      background-color: #fff;
      box-shadow: 3px 2px 30px rgba(0,0,0,.1);
      .p1{
        padding-top: 30px;
        height: 21px;
        line-height: 21px;
        font-size: 18px;
        color: #333;
        text-align: center;
      }
      .p1p{
        text-align: left;
        padding-left: 20px;
        color: #fff;
      }
      .p2{
        padding-top: 10px;
        height: 16px;
        line-height: 16px;
        margin-bottom: 33px;
        font-size: 14px;
        color: #666;
        text-align: center;
      }
      .p2p{
        text-align: left;
        padding-left: 30px;
        color: #fff;
      }
      .go{
        display: none;
        width: 74px;
        height: 34px;
        line-height: 34px;
        color: #fff;
        border: 2px solid #fff;
        border-radius: 18px;
        font-size: 14px;
        text-align: center;
        margin-left: 20px;
      }
      .gg{
        display: block;
      }
      .img img{
        position: absolute;
        width: 150px;
        height: 150px;
        right: 26px;
        bottom: 40px;
        transition: ease-out  1s;
      }
      .img img.imgg{
        position: absolute;
        width: 270px;
        height: 270px;
        right: 0px;
        bottom: 0px;
      }
    }
    .winLi:first-child{
      width: 400px;
      background-color: #3288e6;
    }
  }
}
.goods{
	width: 100%;
	background: #fff;
	.goodsMachine{
		margin: 0 auto;
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
.fix{
	position: fixed;
	width: 60px;
	top: 335px;
	right: 60px;
	background: #f6f9fa;
	border: 1px solid #e5e9ef;
	border-radius: 10px;
	overflow: hidden;
	z-index: 999;
	li{
		padding: 15px 0px;
		text-align:center;
		transition: background-color .3s,color .3s;
		border-bottom: 1px solid #e5e9ef;
		cursor: pointer;
	}
	li:hover{
		background: #00a1d6;
		color:#fff;
	}
}
</style>

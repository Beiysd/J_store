<template>
    <div>
            <div class="bar_title">
                <li>商品ID</li>
                <li>商品名</li>
                <li>商品简介</li>
                <li>图片链接</li>
                <li>商品价格</li>
                <div class="search">
                    <input class="se_inp" type="text" name="search" value="" placeholder="根据商品ID查询">
                    <span class="icon-search" @click="search"></span>
                </div>
                <router-link :to="{name:'add_goods',params:{DBID:dbId}}">
                    <button class="add">添加商品</button>
                </router-link>
                <div class="act">操作</div>
                
            </div>
            <div class="next_title" v-for="(item,index) in this.goodsList" :key="index">
                <div>
                    <div class="ul" :class="{active:show_search===index}">
                        <input class="ff" name="f_id" readonly="readonly" type="text"  :value="item.id">
                        <input class="ff" name="f_name" readonly="readonly" type="text"  :value="item.name">
                        <input class="ff" name="f_tjremake" readonly="readonly" type="text"  :value="item.tjremake">
                        <input class="ff" name="f_imgurl" readonly="readonly" type="text"  :value="item.imgurl">
                        <input class="ff" name="f_price" readonly="readonly" type="text"  :value="item.price">
                        <button class="xiu" @click="xiu(index)">编辑</button>
                        <button class="del" @click="del(index)">删除</button>
                    </div>
                    <div class="ul" v-show="show_num === index">
                        <input class="il" name="i_id" type="text"  :value="item.id">
                        <input class="il" name="i_name" type="text"  :value="item.name">
                        <input class="il" name="i_tjremake" type="text"  :value="item.tjremake">
                        <input class="il" name="i_imgurl" type="text"  :value="item.imgurl">
                        <input class="il" name="i_price" type="text"  :value="item.price">
                        <button class="succ" @click="succ(index)">完成</button>
                    </div>
                </div>
            </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            name:'homeele_goods',
            goodsList:[],
            show_num:'',
            searchNum:'',
            show_search:'',
            searchRes:[],
            dbId:'phone_goods'
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
        xiu(val){
            this.show_num = val
            let vf = $("input[name='f_id']")[val].value
            console.log('fid'+vf)
            // let data = {'id':vf}
            // this.$http.post("http://127.0.0.1/sever/admin_allgoods/allgoods_xiu.php",data)
            // .then((res)=>{})

        },
        del(val){
            //编辑
            let f_id = $("input[name='f_id']")[val].value
            console.log(f_id)
            let del_data = {'id':f_id,'dbId':this.dbId}
            this.$http.post("http://127.0.0.1/sever/admin_allgoods/allgoods_xiu.php",del_data)
            .then((res)=>{
                alert ('删除成功,请刷新页面!')
            })
        },
        succ(val){
            this.show_num = -(val+1)
            console.log(this.show_num)
            //编辑
            let f_id = $("input[name='f_id']")[val].value
            let f_name = $("input[name='f_name']")[val].value
            let f_tjremake = $("input[name='f_tjremake']")[val].value
            let f_imgurl = $("input[name='f_imgurl']")[val].value
            let f_price = $("input[name='f_price']")[val].value
            //完成
            let i_id = $("input[name='i_id']")[val].value
            let i_name = $("input[name='i_name']")[val].value
            let i_tjremake = $("input[name='i_tjremake']")[val].value
            let i_imgurl = $("input[name='i_imgurl']")[val].value
            let i_price = $("input[name='i_price']")[val].value

            if(!i_id || !i_name || !i_tjremake || !i_imgurl || !i_price){
                alert('输入不得为空!')
            }else{
                //删除数据
                let del_data = {'id':f_id,'dbId':this.dbId}
                this.$http.post("http://127.0.0.1/sever/admin_allgoods/allgoods_xiu.php",del_data)
                .then((res)=>{
                    //添加数据
                    let data = {
                        'id': i_id,
                        'name': i_name,
                        'tjremake': i_tjremake,
                        'imgurl': i_imgurl,
                        'price': i_price,
                        'dbId':this.dbId
                    }
                    console.log(data)
                    this.$http.post("http://127.0.0.1/sever/admin_allgoods/allgoods_succ.php",data)
                    .then((res)=>{
                        let num = res.data
                        if(num == 0){
                            console.log('num--'+num)
                            alert('商品ID已存在!')
                            //重新添加删除的数据
                            let add_data = {
                                'id': f_id,
                                'name': f_name,
                                'tjremake': f_tjremake,
                                'imgurl': f_imgurl,
                                'price': f_price,
                                'dbId':this.dbId
                            }
                            console.log(data)
                            this.$http.post("http://127.0.0.1/sever/admin_allgoods/allgoods_succ.php",add_data)
                            .then((res)=>{})
                        }else{
                            console.log('succe')
                            alert('编辑完成，请刷新页面!')
                        }
                    })
                })
            }
        },
        search(){
            console.log('se-')
            this.searchNum = $("input[name='search']").val()
            let data = {'id':this.searchNum,'dbId':this.dbId}
            this.$http.post("http://127.0.0.1/sever/admin_allgoods/allgoods_search.php",data)
            .then((res)=>{
                let num = res.data
                if(num == 0){
                    alert('该商品ID不存在!')
                }else{
                    this.searchRes = res.data
                    let ind = this.goodsList.findIndex((item,index) => {
                        if(item.id == this.searchNum){
                            // console.log('false--'+item.id)
                            // console.log('fa--'+index)
                            this.show_search = index
                            alert('查询成功，结果边框为蓝色!')
                        }
                    })
                }
            })
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
        padding: 6px 0;
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

</style>

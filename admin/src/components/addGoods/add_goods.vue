<template>
    <div>
        <input class="inp" type="text" name="id" value="" placeholder="商品ID">
        <input class="inp" type="text" name="name" value="" placeholder="商品名称">
        <textarea v-model="tjremake" placeholder="商品详情"></textarea>
        <!-- <input class="inp" type="text" name="tjremake" value="" placeholder="商品详情"> -->
        <input class="inp" type="text" name="imgurl" value="" placeholder="图片链接">
        <input class="inp" type="text" name="price" value="" placeholder="商品价格">
        <button @click="sub">提交</button>

    </div>
</template>
<script>
export default {
    data(){
        return{
            name:'add_goods',
            tjremake:''
        }
    },
    methods:{
        sub(){
            let a_id = $("input[name = 'id']").val()
            let a_name = $("input[name = 'name']").val()
            let a_imgurl = $("input[name = 'imgurl']").val()
            let a_price = $("input[name = 'price']").val()
            let num = Number(a_id)

            //判断不为空
            if(!a_id || !a_name || !this.tjremake || !a_imgurl || !a_price){
                alert('输入信息不得为空!')
            }else if(a_price <= 0){
                alert('商品价格不得为零和负数!')
            }else if(!num){
                alert('商品ID需为正整数!')
            }else{
                let data = {
                    'id':a_id,
                    'name':a_name,
                    'tjremake':this.tjremake,
                    'imgurl':a_imgurl,
                    'price':a_price,
                    'dbId':this.dbid
                }
                console.log(data)
                this.$http.post("http://127.0.0.1/sever/admin_allgoods/allgoods_succ.php",data)
                .then((res)=>{
                    let num = res.data
                    if(num == 0){
                        alert('商品ID已存在!')
                    }else{
                        alert('商品添加成功!')
                    }
                })
            }
        }
    },
    computed:{
        dbid(){
            return this.$route.params.DBID
        }
    }
}
</script>
<style scoped lang="scss">
.inp{
    width: 600px;
    padding: 10px 5px;
    margin-bottom: 10px;
    outline: none;
}
textarea{
    display: block;
    width: 600px;
    padding: 10px 5px;
    margin-bottom: 10px;
    height: 85px;
    outline: none;
}
button{
    display: block;
    width: 100px;
    padding: 10px;
    margin-left: 514px;
    border: none;
    cursor: pointer;
}
</style>



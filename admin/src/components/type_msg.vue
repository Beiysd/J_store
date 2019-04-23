<template>
    <div class="type_msg">
        <div class="tt">
          <span>项目名称：</span><i>基于web的网站购物系统的设计与实现</i>
        </div>
        <div class="tt">
          <span>项目描述：</span><i>一个PC端购物网站系统，前台已实现用户登录，注册，商品搜索，添加商品至购物车，创建订单,查看历史订单功能。后台已实现对商品，用户和管理人员的增、删、改、查功能，以及对用户订单的查询功能。</i>
        </div>
        <div class="tt">
          <span>项目环境：</span><i>Vue 2.0，phpAdmin（php+mySql 的集成服务），Visual Studio Code（编码工具）</i>
        </div>
        <div class="tt">
          <span>开发人员：</span><i>吴晓东</i>
        </div>
        <div class="tt">
          <span>所属：</span><i>计算机学院——网络工程2班</i>
        </div>
        <div class="tt">
          <span>上线日期：</span><i>暂无</i>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{

        }
    }
}
</script>
<style scoped lang="scss">
.type_msg{
    width: 600px;
    margin: 0 auto;
    margin-top: 10px;
    font-size: 18px;
    .tt{
    clear: both;
    padding: 30px 0;
    span{
        float: left;
        width: 100px;
        font-weight: 700;
    }
    i{
        float: right;
        width: 500px;
        text-align: justify;
        font-style: normal;
        font-size: 20px;
    }
    }
}
</style>



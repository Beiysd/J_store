<template>
  <div class="loading"><img src="https://qidian.gtimg.com/qd/images/logo.beebc.png" alt=""></div>
</template>
<script>
    export default{
        //data为工厂模式
        data(){
            return {
                name: 'isLoading'
            }
        }
    }
</script>
<style lang="scss">
  .loading{
    position:fixed;
    top:0;
    left:0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    img{
      display: block;
      margin: 0 auto;
      margin-top: 50%;
    }
  }
</style>

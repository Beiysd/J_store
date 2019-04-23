<template>
  <div id="app">
    <router-view :names.sync="names"/>
  </div>
</template>

<script>
export default {
  name: 'App',
  names:''
}
</script>

<style>
*{
  margin: 0;
  padding: 0;
  text-decoration: none;
  list-style: none;
  font-style: normal;
}
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
} */
</style>

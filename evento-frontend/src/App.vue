<template>
  
  <router-view/>
  
</template>
<script>
  
  window.$ = window.jQuery = require("@/assets/js/jquery-3.2.1.min.js");
  require("@/assets/js/modernizr.js")
  require("@/assets/js/pace.min.js")
  require("@/assets/js/plugins.js")
  require("@/assets/js/main.js")

</script>

<style>
    @import '@/assets/css/base.css';
    @import '@/assets/css/demo.css';
    @import '@/assets/css/vendor.css';
    @import '@/assets/css/app.css';
    @import '@/assets/css/main.css'; 
    .add-btn {
  background-color: #fff;
  border: 1px solid #0077b5;
 height: 45px;
  padding: 0 19px;
  margin: 0;

  border-radius: 0.4em;
  color: #0077b5;
}

.add-btn:hover {
  background-color: #0077b5;
  color: #fff;

}
.flxbox{
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
.op{
    opacity: 0.4 !important;
    background-color: #760064 !important;
    color: aliceblue !important;
}
.os{
    opacity: 0.4 !important;
    background-color: #186592 !important;
    color: aliceblue !important;
}
</style>

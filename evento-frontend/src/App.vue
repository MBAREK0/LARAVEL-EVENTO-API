<template>
  
  <router-view/>
  
</template>
<script>
  // window.$ = window.jQuery = require('jquery');

  // $(()=> console.log("éh"))
  // import "assets/js/app.js";
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
    
   
</style>

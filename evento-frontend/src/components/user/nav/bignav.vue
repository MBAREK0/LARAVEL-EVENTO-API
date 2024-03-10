<template>
<nav id="navv">
<smallNav/>
 <div class="main-head">
  <div class="second-head">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    <div class="flx">
    <div class="search">
        <input placeholder="Search..."   v-model="searchQuery" type="text">
        <button type="submit" @click="sendSearchQuery">Go</button>
      </div>
    </div>
  </div>
 </div>
</nav>

</template>

<script>
import smallNav from './nav.vue'
export default {
  components :{
    smallNav
  },
  data(){
    return{
        searchQuery:'',
    }
  
  },
   methods: {
    sendSearchQuery() {
      this.$emit("search", this.searchQuery);
    },
  },
}
</script>

<style scoped>
#navv{
background-image: url('https://wallpapers.com/images/hd/concert-background-dd0syeox7rmi78l0.jpg');
height: 400px;
background-size: cover;
background-repeat: no-repeat;
 
}
.main-head{
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;

}
.second-head{
  color: #fff;
  width: 100%;
  height: fit-content;
  text-align: center;
}
.search {
  display: inline-block;
  position: relative;
  width: 40%;

}

.search input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1PX solid #4e99e9;
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin: 0;
  color: #fff;
}

.search button[type="submit"] {
background-color: #4e99e9;
  border: none;
  color: #fff;
  cursor: pointer;
  padding: 6px 20px;
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  position: absolute;
  top: 0px;
  right: 0;
  transition: .9s ease;
  height: 59px;
  margin: 0;
}

.search button[type="submit"]:hover {
  transform: scale(1.1);
  color: rgb(255, 255, 255);
  background-color: #00bfff96;
}

.flx{
  display: flex;
  align-items: center;
  gap: 6px;
  justify-content: center;
}
</style>
<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../../../assets/logo.png" width="70px" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <router-link :to="{name : 'home'}" class="nav-link">
            <li class="nav-item">
              <a href="#" class="nav-link">Home</a>
            </li>
          </router-link>
          <router-link :to="{name : 'organizer'}" class="nav-link" v-if="role === '2' || role === '3'">
            <li class="nav-item">
              <a href="#" class="nav-link">Organizer Space</a>
            </li>
          </router-link>
          <router-link :to="{name : 'admin'}" class="nav-link" v-if="role === '3'">
            <li class="nav-item">
              <a href="#" class="nav-link">Admin Space</a>
            </li>
          </router-link>
        </ul>
        <router-link :to="{name : 'sign-in'}" class="nav-link" v-if="!islogin">
          <a href="#" class="nav-link-sign">Sign In</a>
        </router-link>
        <router-link :to="{name : 'sign-up'}" class="nav-link" v-if="!islogin">
          <a href="#" class="nav-link-sign">Sign up</a>
        </router-link>
        <router-link :to="{name : 'logout'}" class="nav-link" v-if="islogin">
          <a href="#" class="nav-link-sign">Logout</a>
        </router-link>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data(){
    return{
      islogin:false,
      role:null
    }
  },
  mounted(){
        const islogin = localStorage.getItem('isLogin');
        const role = localStorage.getItem('role');
        this.islogin= islogin;
        this.role= role;
       
  }
}
</script>

<style scoped>
/* Navbar styles */
.navbar {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
}

/* Navbar brand styles */
.navbar-brand {
  font-size: 1.5rem;
}

/* Navbar toggler styles */
.navbar-toggler {
  border-color: rgba(255, 255, 255, 0.1);
}

/* Navbar link styles */
.navbar-nav .nav-item {
  margin: 0 10px;
}

.navbar-nav .nav-link {
  font-size: 1.5rem;
}

/* Active link styles */
.navbar-nav .nav-link.active,
.navbar-nav .nav-item:hover .nav-link {
  color: #fff;
}

/* Sign In link styles */
.navbar-nav .nav-link.sign-in {
  background-color: #fff;
  color: #fff;
  border-radius: 4px;
  padding: 8px 12px;
}

.navbar-nav .nav-link.sign-in:hover {
  background-color: #0056b3;
}
 a.router-link-exact-active a{
 border-bottom:1px solid #0056b3 ;
 color: #fff !important;
}
.nav-link-sign{
  color: #fff !important;
}
.nav-link-sign:hover {
  color: #00bfff96 !important;
}
</style>

<template>
    <nav class="navbar navbar-expand-lg    navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">[LOGO]</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <router-link :to="{name : 'home'}">
          <li class="nav-item">
            <a class="nav-link" href="#">home</a>
          </li>
        </router-link>
        <router-link :to="{name : 'event'}">
          <li class="nav-item">
            <a class="nav-link" href="#">event</a>
          </li>
        </router-link>
          <router-link :to="{name : 'makeEvents'}">
          <li class="nav-item">
            <a class="nav-link" href="#">makeEvents</a>
          </li>
        </router-link>
      </ul>
      <router-link :to="{name : 'sign-in'}">
      
            <a class="nav-link" href="#">Sign In</a>
         
        </router-link>
    </div>
  </div>
</nav>
</template>

<script>
export default {

}
</script>

<style>
.navbar{
    position:fixed !important;
    top: 0 !important;
    width: 100%;
    z-index: 800 !important;
}
 a.router-link-exact-active {
 background-color: tomato;
}


</style>
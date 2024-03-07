<template>
  
</template>

<script>
import axios from 'axios';

export default {
created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const accessToken = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
        const response = await axios.post('http://127.0.0.1:8000/api/logout');
        
        if(response.data.message === 'Successfully logged out'){
            localStorage.removeItem('accessToken');
            localStorage.removeItem('isLogin');
            localStorage.removeItem('role');
            this.$router.push('/sign-in');
        }
      } catch (error) {
        console.error('logout Error :', error);
      }
    }
  }
};
</script>

<style>

</style>
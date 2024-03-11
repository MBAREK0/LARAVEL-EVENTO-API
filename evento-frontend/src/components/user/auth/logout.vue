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
        const response = await axios.post('http://127.0.0.1:8000/api/logout');
        if(response.data.message === true ){
            localStorage.clear();
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
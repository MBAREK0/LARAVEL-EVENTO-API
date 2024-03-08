<template>
      <!-- home
    ================================================== -->
    <main class="s-home s-home--slides info-is-visible">

        <div class="home-slider">
            <div class="home-slider-img"  ref="homeSliderImg"></div>

        </div>

        <div class="overlay"></div>

        <div class="home-content">

            <div class="home-logo">
               <router-link :to="{name :'home'}">
                    <img src="../../../assets/logo.png" alt="Homepage">
                </router-link>
            </div>
            <div class="row home-content__main">
   
                <form class="form" @submit.prevent="reset">
                    <p class="title">Reset Password </p>   
                    <p class="message">update your password  </p>
                    <div v-if="validationError" class="alert alert-danger op">
                        {{ validationError }}
                    </div>
                    <div v-if="secsses" class="alert os ">
                    password updated successfully
                    </div>
                    <label>
                        <input class="input" type="password" v-model="password" placeholder="" required>
                        <span>new password</span>
                    </label> 
                    <label>
                        <input class="input" type="text" v-model="reset_token" placeholder="" hidden>
                    </label> 
                    <button class="submit">Send</button>
                </form>
               
            </div>
  
            <ul class="home-social">
                <li>
                <a href="#0"><i class="fab fa-google" aria-hidden="true"></i><span>GOOGEL</span></a>
                </li>
             
            </ul> <!-- end home-social -->

      

            <div class="home-content__line"></div>

        </div> <!-- end home-content -->

    </main> <!-- end s-home -->
 <foooter/>
</template>

<script>
import foooter from '../nav/footer.vue'
import axios from 'axios';

export default {
  components : {
    foooter
  },
   data() {
    return {
      password: '',
      reset_token:localStorage.getItem('reset_token'),
      error: null,
      validationError:null,
      secsses:false,
    };
  },
  methods: {
    reset() {
      axios.post('http://127.0.0.1:8000/api/auth/resetPassword', {
        password: this.password,
        reset_token: this.reset_token,
      })
      .then(response => {
               if(response.data.message === 'Password updated successfully'){
                     this.secsses = true;
                     setTimeout(()=>{  
                        localStorage.removeItem('reset_token');
                        this.secsses = false ;
                        this.$router.push('/sign-in');

                     },2500)
               } 
      })
      .catch(error => {
       if (error.response && error.response.status === 422) {
          const validationErrors = error.response.data.errors;
          this.displayValidationErrors(validationErrors);
      } else {
          console.error('Error:', error.message);
     }
      });
    },
     displayValidationErrors(errors) {
    for (const field in errors) {
      if (errors.hasOwnProperty(field)) {
        const errorMessage = errors[field][0]; 
        console.error(`${field}: ${errorMessage}`);
        this.validationError = errorMessage; 
      }
    }
  }
  }
};
</script>


<style scoped>
.home-slider-img{
    background-image: url('https://media.istockphoto.com/id/1391169357/vector/violet-neon-lines-and-triangle-abstract-technology-background.jpg?s=612x612&w=0&k=20&c=oeAXgnfN31SZrBy_Gf6Yp3lyG_jSetRvCS2Ig0x1eWw=');
}

.modal-form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 800;
    width: 50% !important;
 
}
.form {
   display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 20px;
    border-radius: 20px;
    position: relative;
    background-color: rgba(255, 255, 255, 0.1); /* Transparent background */
    color: #fff;
    border: 1px solid #333;
    backdrop-filter: blur(10px); /* Blur effect */
}

.title {
  font-size: 28px;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
  color: #0087cc;
}

.title::before {
  width: 18px;
  height: 18px;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.title::before,
.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: #0087cc;
}




.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  position: relative;
}

.form label .input {
  background-color: #333;
  color: #fff;
  width: 100%;
  padding: 20px 05px 05px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .input + span {
  color: rgba(255, 255, 255, 0.5);
  position: absolute;
  left: 10px;
  top: 0px;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .input:placeholder-shown + span {
  top: 12.5px;
  font-size: 0.9em;
}

.form label .input:focus + span,
.form label .input:valid + span {
  color: #00bfff;
  top: 0px;
  font-size: 0.7em;
  font-weight: 600;
}

.input {
  font-size: medium;
}

.submit {
  border: none;
  outline: none;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
  background-color: #0087cc;
}

.submit:hover {
  background-color: #00bfff96;
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}
@media (min-width: 800px) {
 .home-content__main{
    display: flex;
    justify-content: center;


 }
 .form{
    width: 60%;
 }
}
@media (min-width: 1000px) {
 .home-content__main{
    display: flex;
    justify-content: center;


 }
 .form{
    width: 50%;
 }
}
</style>
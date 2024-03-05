<template>
      <!-- header 
    ================================================== -->
   <smallNav/>
    <!-- end header -->
      <!-- home
    ================================================== -->
    <main class="s-home s-home--slides info-is-visible">

        <div class="home-slider">
            <div class="home-slider-img"  ref="homeSliderImg"></div>

        </div>

        <div class="overlay"></div>

        <div class="home-content">
            <div class="row home-content__main">

                <div class="col-eight home-content__text pull-right">
                    <h3>Welcome to Count</h3>

                    <h1>
                    We are currently working <br>
                    on a new super awesome <br> website.
                    </h1>

                   

                </div>  <!-- end home-content__text -->

                <div class="col-four home-content__counter">
                    <h3>Launching In</h3>

                    <div class="home-content__clock">
                        <div class="top">
                            <div class="time days">
                                325
                                <span>Days</span>
                            </div>
                        </div>    
                        <div class="time hours">
                            09
                            <span>H</span>
                        </div>
                        <div class="time minutes">
                            54
                            <span>M</span>
                        </div>
                        <div class="time seconds">
                            30
                            <span>S</span>
                        </div>
                    </div>  <!-- end home-content__clock -->
                </div>  <!-- end home-content__counter -->

            </div>  <!-- end home-content__main -->

            <ul class="home-social">
                <li>
                <a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i><span>Facebook</span></a>
                </li>
                <li>
                <a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i><span>Twiiter</span></a>
                </li>
                <li>
                <a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                </li>
            </ul> <!-- end home-social -->

      

            <div class="home-content__line"></div>

        </div> <!-- end home-content -->

    </main> <!-- end s-home -->


    <!-- info
    ================================================== -->
    <a class="info-toggle" href="#0"  @click="toggleInfo">
        <span class="info-menu-icon"></span>
    </a>

    <div class="s-info">

        <div class="row info-wrapper">

            <div class="col-seven tab-full info-main">
                <h1>We are Count. We make awesome stuff.</h1>
                <p>
                Quisque velit nisi, pretium ut lacinia in, elementum id enim. Mauris blandit aliquet elit, 
                eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in, elementum id enim. 
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; 
                Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                </p>
                <div @click="toggleModel" width="100%">
                <ticket/>   
                </div>
            </div>
           
            <div class="col-four tab-full pull-right info-contact">

                <div class="info-block">
                    <h3>Start A Conversation</h3>
                    <p>
                        <a href="mailto:#0" class="info-email">mailus@ourwebsite.com</a><br>
                        <a href="tel:+18587338912" class="'info-phone">+1.858.733.8912</a>
                    </p>
                </div>

                <div class="info-block">
                    <h3>Visit Our Office</h3>
                    
                    <p class="info-address">
                        1600 Amphitheatre Parkway<br>
                        Mountain View, CA<br>
                        94043 US
                    </p>
                </div>

                <div class="info-block">
                    <h3>Find Us On</h3>
                    
                    <ul class="info-social">
                        <li>
                            <a href="#0"><i class="fab fa-facebook" aria-hidden="true"></i>
                            <span>Facebook</span></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i>
                            <span>Twiiter</span></a>
                        </li>
                        <li>
                            <a href="#0" ><i class="fab fa-instagram" aria-hidden="true"></i>
                            <span>Instagram</span></a>
                        </li>
                    </ul>
                </div>
                
            </div>  <!-- end info contact -->

        </div>  <!-- end info wrapper -->

    </div> <!-- end s-info -->
   <div v-if="model" class="modal-form">
    <form class="form">
        <p class="title">Evento </p>
        
            <div class="flex">
            <label>
                <input class="input" type="text" placeholder="" required>
                <span>Firstname</span>
            </label>

            <label>
                <input class="input" type="text" placeholder="" required>
                <span>Lastname</span>
            </label>
        </div>  
                
        <label>
            <input class="input" type="email" placeholder="" required>
            <span>Email</span>
        </label> 
            
        <label>
            <input class="input" type="date" placeholder="" required>
            <span>age</span>
        </label>
        <button class="submit" >CheckOut</button>
    </form>

   </div>

   

</template>

<script>
import ticket from './cards/ticket.vue'
import smallNav from './nav/nav.vue'

export default {
  data() {
    return {
      path: '',
      model:false,
      
 
    }
  },
  components:{
    ticket,
    smallNav
  },
  methods: {
    toggleInfo() {
      // Open/close lateral navigation
      this.$nextTick(() => {
        // Toggle the class on the body
        document.body.classList.toggle('info-is-visible');
      });
    },
     toggleModel() {
      this.model = !this.model;
    }
  },
  

};
</script>


<style scoped>
.home-slider-img{
    background-image: url('https://wallpapers.com/images/hd/concert-background-dd0syeox7rmi78l0.jpg');
}
.modal-form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 800;
 
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
@media screen and (max-width: 800px) {
  .modal-form{
  width: 90% !important;
}
}

</style>
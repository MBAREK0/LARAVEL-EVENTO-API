<template>
      <!-- header 
    ================================================== -->
   <smallNav/>
    <!-- end header -->
      <!-- home
    ================================================== -->
    <main class="s-home s-home--slides info-is-visible">

        <div class="home-slider">
          <div class="home-slider-img" ref="homeSliderImg" :style="{ backgroundImage: 'url(' + fullImagePath() + ')', backgroundSize: 'cover' }"></div>

        </div>

        <!-- <div class="overlay"></div> -->

        <div class="home-content">
            <div class="row home-content__main">
                <div class="col-eight home-content__text pull-right">
                    <h3>Welcome to Evento</h3>

                    <h1>
                   {{ event.title }}
                    </h1>

                </div>  
                <div class="col-four home-content__counter">
                    <h3>Launching In</h3>

                    <div class="home-content__clock"  v-if="!ispassed">
                        <div class="top">
                            <div class="time days">
                                {{ remainingDays }}
                                <span>Days</span>
                            </div>
                        </div>    
                        <div class="time hours">
                            {{ remainingHours }}
                            <span>H</span>
                        </div>
                        <div class="time minutes">
                            {{ remainingMinutes }}
                            <span>M</span>
                        </div>
                        <div class="time seconds">
                            {{ remainingSeconds }}
                            <span>S</span>
                        </div>
                    </div> 
                    <p v-if="ispassed" style="color: #fff;"> Is Passed In {{ event.date }} </p> 
                </div>  
            </div>  

            <ul class="home-social">
                <li>
                <a :href="event.facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i><span>Facebook</span></a>
                </li>
                <li>
                <a :href="event.twitter"><i class="fab fa-twitter" aria-hidden="true"></i><span>Twiiter</span></a>
                </li>
                <li>
                <a :href="event.instagram"><i class="fab fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                </li>
            </ul>
      </div> 
    </main> <!-- end s-home -->


    <!-- info
    ================================================== -->
    <a class="info-toggle" href="#0"  @click="toggleInfo">
        <span class="info-menu-icon"></span>
    </a>

    <div class="s-info">

        <div class="row info-wrapper">

            <div class="col-seven tab-full info-main">
                <h1 >{{ event.title }}</h1>
                <p v-if="message" class="msg">{{ message }}</p>
                <p>
                  {{ event.description }}
                </p>
                <div @click="toggleModel" width="100%">
                <ticket :price="event.prix" @click="reservation" />   
                </div>
            </div>
           
            <div class="col-four tab-full pull-right info-contact">

                <div class="info-block">
                    <h3>Number Of tickets </h3>
                    <p>
                        <a href="mailto:#0" class="info-email">{{ event.number_places }}</a><br>
                    </p>
                </div>

                <div class="info-block">
                    <h3>the {{ event.title }} place </h3>
                    
                    <p class="info-address">
                      {{ event.place }}
                    </p>
                </div>

                <div class="info-block">
                    <h3>Find Us On</h3>
                    
                    <ul class="info-social">
                        <li>
                            <a :href="event.facebook"><i class="fab fa-facebook" aria-hidden="true"></i>
                            <span>Facebook</span></a>
                        </li>
                        <li>
                            <a :href="event.twitter"><i class="fab fa-twitter" aria-hidden="true"></i>
                            <span>Twiiter</span></a>
                        </li>
                        <li>
                            <a :href="event.instagram" ><i class="fab fa-instagram" aria-hidden="true"></i>
                            <span>Instagram</span></a>
                        </li>
                    </ul>
                </div>
                
            </div>  <!-- end info contact -->

        </div>  <!-- end info wrapper -->

    </div> <!-- end s-info -->

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale-pulse-out">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
   

</template>

<script>
import ticket from './cards/ticket.vue'
import smallNav from './nav/nav.vue'
import axios from 'axios'

export default {
  data() {
    return {
      path: '',
      event:'',
      targetDate:'', 
      remainingDays: 0,
      remainingHours: 0,
      remainingMinutes: 0,
      remainingSeconds: 0,
      ispassed:false,
      message:null,
      
 
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
        calculateRemainingTime() {
      const targetTimestamp = new Date(this.targetDate).getTime();
      const currentTimestamp = new Date().getTime();
      const timeDifference = targetTimestamp - currentTimestamp;

      if (timeDifference > 0) {
        // Calculate days, hours, minutes, and seconds
        this.remainingDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        this.remainingHours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        this.remainingMinutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        this.remainingSeconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
      } else {
        // The target date has passed
        this.remainingDays = 0;
        this.remainingHours = 0;
        this.remainingMinutes = 0;
        this.remainingSeconds = 0;
        this.ispassed = true;
      }
    },    
    fullImagePath() {
      return `http://127.0.0.1:8000/storage/${this.event.image_path}`;
    },
    reservation(){
      const islogin = localStorage.getItem('isLogin');
      if(islogin){
        this.add_reservation(this.event.id);
      }else{
        this.$router.push('/sign-in');
      }
    },
   async add_reservation(id){
       try {
            const accessToken = localStorage.getItem('accessToken');
            axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
            const response = await axios.post('http://127.0.0.1:8000/api/add_reservation', {
              id: id
            });
            this.message = 'we will send you an email whene the organizer accepted you';
            setTimeout(() => {
              this.message = null;
            }, 2000);
          } catch (error) {
            console.error('Error adding reservation:', error);
          }
    }
    
  },
  mounted(){
    this.event = JSON.parse(this.$route.query.data);
    this.targetDate = this.event.date;
     this.calculateRemainingTime();
    setTimeout(()=>{
          document.getElementById('preloader').style.display = 'none';
    },1001)
    // Optionally, you can set up a timer to update the remaining time every second
    setInterval(() => {
      this.calculateRemainingTime();
    }, 1000);
  }
  

};
</script>


<style scoped>
/* .home-slider-img{
    background-image: url('https://wallpapers.com/images/hd/concert-background-dd0syeox7rmi78l0.jpg');
} */
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
#preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #050505;
  z-index: 800;
  height: 100%;
  width: 100%;
  display: table;
 
}
#loader {
  display: table-cell;
  text-align: center;
  vertical-align: middle;
}

.line-scale-pulse-out > div {
  background-color: #ec008c;
  width: 4px;
  height: 35px;
  border-radius: 2px;
  margin: 2px;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  display: inline-block;
  -webkit-animation: line-scale-pulse-out 0.9s -0.6s infinite cubic-bezier(0.85, 0.25, 0.37, 0.85);
  animation: line-scale-pulse-out 0.9s -0.6s infinite cubic-bezier(0.85, 0.25, 0.37, 0.85);
}

.line-scale-pulse-out > div:nth-child(2),
.line-scale-pulse-out > div:nth-child(4) {
  -webkit-animation-delay: -0.4s !important;
  animation-delay: -0.4s !important;
}

.line-scale-pulse-out > div:nth-child(1),
.line-scale-pulse-out > div:nth-child(5) {
  -webkit-animation-delay: -0.2s !important;
  animation-delay: -0.2s !important;
}

@-webkit-keyframes line-scale-pulse-out {
  0% {
    -webkit-transform: scaley(1);
    transform: scaley(1);
  }

  50% {
    -webkit-transform: scaley(0.4);
    transform: scaley(0.4);
  }

  100% {
    -webkit-transform: scaley(1);
    transform: scaley(1);
  }

}

@keyframes line-scale-pulse-out {
  0% {
    -webkit-transform: scaley(1);
    transform: scaley(1);
  }

  50% {
    -webkit-transform: scaley(0.4);
    transform: scaley(0.4);
  }

  100% {
    -webkit-transform: scaley(1);
    transform: scaley(1);
  }

}
.msg{
  background-color: #0087cc;
  opacity: 0.5;
  color: #fff;
  border-bottom: 1px solid #fff;
  padding: 5px 10px;
}
</style>
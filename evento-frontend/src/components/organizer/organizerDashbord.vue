<template>
  <smallNav/>
      <div class="main-content container" id="panel">
        <div class="container-fluid pt-3">
          <h6 class="hello">Hello Organize </h6>
          <div class="row removable">
            <cart  :statistics="E_Accepted"  :EventStatus="stat_1"/>
            <cart  :statistics="E_Not_Accepted"  :EventStatus="stat_2"/>

          </div>
          <div class="flxbox">
          <div>
              <div class="radio-buttons-container">
                <div class="radio-button">
                  <input name="radio-group" id="radio2" class="radio-button__input" type="radio" v-model="selectedOption" value="My Events" ref="radio2">
                  <label for="radio2" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    My Events
                  </label>
                </div>
                <div class="radio-button">
                  <input name="radio-group" id="radio1" class="radio-button__input" type="radio" v-model="selectedOption" value="Reservations" ref="radio1">
                  <label for="radio1" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    Reservations
                  </label>
                </div>
              </div>
          </div>
          <button class="add-btn" @click="showForm">
            Add Event
          </button>
          </div>
          <div class="card mb-4" v-if="table1">
             <Events/>
          </div>
          <div class="card mb-4" v-if="table2">
              <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover">
                          <thead>
                              <tr >
                                  <th scope="col" class="text-white">user</th>
                                  <th scope="col" class="text-white">event</th>
                                  <th scope="col" class="text-center text-white"></th>
                                  <th scope="col" class="text-white"></th>
                                  <th scope="col" class="text-white"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="reservation in reservations" :key="reservation.id">
                      
                                  <td class="align-middle ">
                                      <span class="badge badge-sm  text-xs">{{ reservation.email }}</span>
                                  </td>
                                  <td class="align-middle ">
                                      <span class="badge badge-sm  text-xs">{{ reservation.title }}</span>
                                  </td>
                                  <td class="align-middle">
                                      <a href="javascript:;" class="text-secondary font-weight-bold bl" data-toggle="tooltip" data-original-title="Edit user" @click="approved(reservation.id)" >approved</a>
                                  </td>
                                  <td class="align-middle">
                                      <a href="javascript:;" class="text-secondary font-weight-bold rd" data-toggle="tooltip" data-original-title="Edit user" @click="rejected(reservation.id)" >rejected</a>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    
    <form class="form" v-if="Form"  @submit.prevent="submitEvent">
      <p class="title">Add New Event </p>
      <div class="flex">
          <label>
              <input class="input" type="text" v-model="title" placeholder="" required>
              <span>Title</span>
          </label>
          <label>
              <select  class="input" v-model="type_reserved" >
                <option value="manuel" selected>manuel</option>
                  <option value="automatic" >automatic</option>
              </select>
              <span>type of reserved</span>
          </label>
      </div>  
     <label>
      <p>category</p>
          <select name="" class="input" v-model="id_categorie">
              <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
          </select>
      </label>
      <label>
      
        <textarea class="input" v-model="description" required></textarea>
          <span>description</span>
      </label> 
          
      <label>
          <input class="input" type="date" v-model="date" required>
          <span>date</span>
      </label>
      <label>
          <input class="input" type="text" v-model="place" required>
          <span>place </span>
      </label>
       <label>
       
          <input class="input" type="number" v-model="prix" required>
          <span>price <small>Please enter a valid number</small></span>
      </label>
         <label>
          <input class="input" type="number" v-model="number_places" required>
          <span>number of places <small>Please enter a valid number</small></span>
      </label>
         <label>
          <input class="input" type="text" v-model="instagram" required>
          <span>instagram Link</span>
      </label>
         <label>
          <input class="input" type="text" v-model="facebook" required>
          <span>facebook Link</span>
      </label>
         <label>
          <input class="input" type="text" v-model="twitter" required>
          <span>twitter Link</span>
      </label>  
      <input type="file" @change="handleFileChange">
 
      <button class="submit">POST</button>
       <button class="anuler" @click="showForm">cancel</button>
    </form>
   
    </div>
</template>

<script>
import cart from './dash/statistique-cart.vue'
import smallNav from '../user/nav/nav.vue'
import upload from  '../user/cards/upload.vue'
import Events from './handelEvents.vue' 
import axios from 'axios'
export default {
  data(){
    return{
      stat_1:'Events Accepted',
      stat_2:'Events Not Accepted',
      E_Accepted:'',
      E_Not_Accepted:'',
      validationError:'',
      table1:true,
      table2:false,
      selectedOption: 'My Events',
      Form : false,
      categories:'',
      title:'',
      description:'',
      number_places:'',
      place:'',
      prix:'',
      date:'',
      type_reserved:'',
      id_categorie:'',
      instagram:'',
      facebook:'',
      twitter:'',
      selectedFile:'',
      reservations:[],
    }
  },
  components : {
    cart,
    smallNav,
    upload,
    Events
  },
  updated() {
    // Check if the radio buttons are checked
    if (this.$refs.radio2.checked) {
      this.table1 = true ;
      this.table2 = false ;
    } else {
      this.table1 = false ;
      this.table2 = true ;
    }
  },
  methods:{
      showForm(){
    this.Form = !this.Form; 
  },
        async fetchCategories() {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.get('http://127.0.0.1:8000/api/index-category');
          this.categories = response.data.categories;
          console.log(response.data);
        } catch (error) {
          console.error('Error from categories:', error);
        }
      },
      async submitEvent() {
     
        if (!this.selectedFile) {
          // console.error('please select a picture .');
           this.validationError = 'please select a picture .';
          return;
         
        }
        // Perform the image upload
        const imagePath = await this.uploadImageFile(this.selectedFile);
        // Send the data to the backend
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/store-event', {
          title: this.title,
          type_reserved: this.type_reserved,
          id_categorie: this.id_categorie,
          description: this.description,
          date: this.date,
          place: this.place,
          prix: this.prix,
          number_places: this.number_places,
          instagram: this.instagram,
          facebook: this.facebook,
          twitter: this.twitter,
          image_path: imagePath,
          });
          console.log('Event added successfully:', response.data);
        } catch (error) {
            if (error.response && error.response.status === 422) {
           
          console.log('errooorrr ====>',error.response.data.errors);
           this.displayValidationErrors(validationError);
      } else {
          console.error('Error:', error.message);
     }
        }
       this.fetchStatistics();
       this.showForm();
        
     },

  async uploadImageFile(file) {
    try {
      const formData = new FormData();
      formData.append('image', file);
      const response = await axios.post('http://127.0.0.1:8000/api/store-image', formData);
      return response.data.path;
    } catch (error) {
      console.error('Error uploading image:', error);
      return 'image/logo.png';
    }
  },
   handleFileChange(event) {
    this.selectedFile = event.target.files[0];
    console.log('Selected File:', this.selectedFile);
  },
    async fetchStatistics() {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.get('http://127.0.0.1:8000/api/organizer-statistics');
          this.E_Accepted = response.data.eventsAccepted;
          this.E_Not_Accepted = response.data.eventsNotAccepted;
        } catch (error) {
          console.error('Error from categories:', error);
        }
      },
       displayValidationErrors(errors) {
      for (const field in errors) {
        if (errors.hasOwnProperty(field)) {
          const errorMessage = errors[field][0]; 
          console.error(`${field}: ${errorMessage}`);
          this.validationError = errorMessage; 
        }
    }
  },
  async get_reservation() {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.get('http://127.0.0.1:8000/api/get_reservation');
          this.reservations = response.data.reservations;
          console.log('=================>',response.data.reservations);
        } catch (error) {
          console.error('Error from reservation:', error);
        }
      },
      async accept_reservation(status,id) {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.put('http://127.0.0.1:8000/api/accept_reservation',{
            id:id,
            status:status
          
          });
         
          // console.log('=================>',response.data.reservations);
        } catch (error) {
          console.error('Error from reservation:', error);
        }
      },
      approved(id){
        this.accept_reservation('approved',id);
            this.fetchStatistics();
            this.fetchCategories();
            this.get_reservation();
      },
      rejected(id){
        this.accept_reservation('rejected',id);
            this.fetchStatistics();
            this.fetchCategories();
            this.get_reservation();
      }

  },
  mounted(){
    this.fetchStatistics();
    this.fetchCategories();
    this.get_reservation();
  }
}
</script>

<style scoped>
.row{
  width: 100%;
  display: flex;
  justify-content: space-around;
  max-width: none;
}
.main-content{
  margin-top: 9rem;

}
.table{
  background-color: black;
  color: #fff;
}
.table span,a,p,h6{
   font-size: 16px !important;
     color: #fff;
     margin: 0; 
}

.removable{
   margin-bottom: 5rem;
}
.radio-buttons-container {
  display: flex;
  align-items: center;
  gap: 24px;
}

.radio-button {
  display: inline-block;
  position: relative;
  cursor: pointer;
}

.radio-button__input {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.radio-button__label {
  display: inline-block;
  padding-left: 30px;
  margin-bottom: 10px;
  position: relative;
  font-size: 16px;
  color: #fff;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
}

.radio-button__custom {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 2px solid #555;
  transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
}

.radio-button__input:checked + .radio-button__label .radio-button__custom {
  transform: translateY(-50%) scale(0.9);
  border: 5px solid #00bfff96 ;
  color: #00bfff96 ;
}

.radio-button__input:checked + .radio-button__label {
  color: #00bfff96 ;
}

.radio-button__label:hover .radio-button__custom {
  transform: translateY(-50%) scale(1.2);
  border-color: #00bfff96 ;
  box-shadow: 0 0 10px #4c8bf580;
}
.hello{
  margin-bottom: 1rem;
}
.add-btn {
  background-color: #fff;
  border: 1px solid #0077b5;
  padding: 2px 10px;

  border-radius: 0.4em;
  color: #0077b5;
}

.add-btn:hover {
  background-color: #0077b5;
  color: #fff;

}
.form{
    position: absolute;
    top: 120%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 800;
    width: 85% !important;
}
.anuler{
   border: 1px solid #0087cc;
  outline: none;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
  background-color: transparent;
}
.upload-image{
  color:rgba(255, 255, 255, 0.5);
}
.bl{
  color: #0087cc !important;
}
.rd{
  color:crimson !important;
}
</style>
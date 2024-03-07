<template>
  <smallNav/>
      <div class="main-content container" id="panel">
        <div class="container-fluid pt-3">
          <h6 class="hello">Hello Organize </h6>
          <div class="row removable">
            <cart/>
            <cart/>
            <cart/>
            <cart/>
          </div>
          <div class="flxbox">
          <div>
              <div class="radio-buttons-container">
                <div class="radio-button">
                  <input name="radio-group" id="radio2" class="radio-button__input" type="radio" v-model="selectedOption" value="Next" ref="radio2">
                  <label for="radio2" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    Next
                  </label>
                </div>
                <div class="radio-button">
                  <input name="radio-group" id="radio1" class="radio-button__input" type="radio" v-model="selectedOption" value="Svelte" ref="radio1">
                  <label for="radio1" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    Svelte
                  </label>
                </div>
              </div>
          </div>
          <button class="add-btn" @click="showForm">
            Add Event
          </button>
          </div>
          <div class="card mb-4" v-if="table1">
              <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-white">Author</th>
                                  <th scope="col" class="text-white">Function</th>
                                  <th scope="col" class="text-center text-white">Status</th>
                                  <th scope="col" class="text-center text-white">Employed</th>
                                  <th scope="col" class="text-white"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <img src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/team-2.jpg" width="50" class="avatar avatar-sm me-3" alt="Author Image">
                                          <div>
                                              <h6 class="mb-0">John Michael 1</h6>
                                          </div>
                                      </div>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="badge badge-sm  text-xs">Online</span>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="badge badge-sm  text-xs">Online</span>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                  </td>
                                  <td class="align-middle">
                                      <a href="javascript:;" class="text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">Edit</a>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          <div class="card mb-4" v-if="table2">
              <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-white">Author</th>
                                  <th scope="col" class="text-white">Function</th>
                                  <th scope="col" class="text-center text-white">Status</th>
                                  <th scope="col" class="text-center text-white">Employed</th>
                                  <th scope="col" class="text-white"></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <img src="https://demos.creative-tim.com/soft-ui-dashboard/assets/img/team-2.jpg" width="50" class="avatar avatar-sm me-3" alt="Author Image">
                                          <div>
                                              <h6 class="mb-0">John Michael 2</h6>
                                          </div>
                                      </div>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="badge badge-sm  text-xs">Online</span>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="badge badge-sm  text-xs">Online</span>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                  </td>
                                  <td class="align-middle">
                                      <a href="javascript:;" class="text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">Edit</a>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    
    <form class="form" v-if="Form">
    
      <p class="message">Signup now and get full access to our app. </p>
      <div class="flex">
          <label>
              <input class="input" type="text" placeholder="" required>
              <span>Event Name </span>
          </label>

          <label>
              <input class="input" type="text" placeholder="" required>
              <span>Event Speaker</span>
          </label>
      </div>  
      <div class="flex">
          <label>
              <input class="input" type="text" placeholder="" required>
              <span>Start Date</span>
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
          <input class="input" type="password" placeholder="" required>
          <span>Password</span>
      </label>
  
      <label class="flex-upload">
      <p class="upload-image">Image</p>
          <upload/>
          

      </label>
      <button class="submit">POST</button>
       <button class="anuler" @click="showForm">cancel</button>
      
      </form>
   
    </div>
</template>

<script>
import cart from './dash/statistique-cart.vue'
import smallNav from '../user/nav/nav.vue'
import eventForm from './event-form.vue'
import upload from  '../user/cards/upload.vue'
export default {
  data(){
    return{
      table1:true,
      table2:false,
      selectedOption: 'Next',
      Form : false
    }
  },
  components : {
    cart,
    smallNav,
    eventForm,
    upload
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
    
  }
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
    top: 50%;
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
</style>
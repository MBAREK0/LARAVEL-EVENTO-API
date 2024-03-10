<template>
  <smallNav/>
      <div class="main-content container" id="panel">
        <div class="container-fluid pt-3">
          <h6 class="hello">Hello Admin </h6>
          <div class="row removable">
            <cart  :statistics="All_Users"  :EventStatus="stat_1"/>
            <cart  :statistics="All_Organizers"  :EventStatus="stat_2"/>
            <cart  :statistics="E_Accepted"  :EventStatus="stat_3"/>
            <cart  :statistics="E_Not_Accepted"  :EventStatus="stat_4"/> 
          </div>
          <div class="flxbox">
          <div>
              <div class="radio-buttons-container">
                <div class="radio-button">
                  <input name="radio-group" id="radio2" class="radio-button__input" type="radio" v-model="selectedOption" value="Users" ref="radio1">
                  <label for="radio2" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    Users
                  </label>
                </div>
                <div class="radio-button">
                  <input name="radio-group" id="radio1" class="radio-button__input" type="radio" v-model="selectedOption" value="Events" ref="radio2">
                  <label for="radio1" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    Events
                  </label>
                </div>
                <div class="radio-button">
                  <input name="radio-group" id="radio3" class="radio-button__input" type="radio" v-model="selectedOption" value="Categories" ref="radio3">
                  <label for="radio3" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    Categories
                  </label>
                </div>
              </div>
          </div>
          <button class="add-btn" @click="handleAdd">
            Add Category
          </button>
          </div>
          <div class="card mb-4" v-if="table1">
              <users/>
          </div>
        <div class="card mb-4" v-if="table2">
          <events/>
          </div>
            <div class="card mb-4" v-if="table3">
              <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-white ">category Name</th>
                                  <th scope="col" class="text-white"></th>
                                  <th scope="col" class="text-white"></th>
                              </tr>
                          </thead>
                          <tbody>
                             <tr v-for="category in categories" :key="category.id">
                              <td>
                                <h6 class="mb-0">{{ category.name }}</h6>
                              </td>
                              <td class="align-middle text-center">
                               <button @click="editCategory(category)">Edit</button>
                              </td>
                              <td class="align-middle text-center">
                                <button @click="deleteCategory(category)">Delete</button>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    
    <form class="form" v-if="Form"  @submit.prevent="handleCategory">
    
      <p class="message">Add new category</p>
      <div class="flex">
          <label>
              <input class="input" type="text" placeholder=""  v-model="newCategoryName" required>
              <span>category Name </span>
          </label>
           
          <input class="input" type="text" placeholder=""  v-model="editingCategoryId" hidden>
          
      </div>
         
      <button class="submit">ADD</button>
       <button class="anuler" @click="showForm">Cancel</button>
      
      </form>
   
    </div>
</template>

<script>
import cart from './dash/statistique-cart.vue'
import smallNav from '../user/nav/nav.vue'
import upload from  '../user/cards/upload.vue'
import users from './handleUsers.vue';
import events from './handleEvents.vue';
import axios from 'axios';
import { BIconEmojiNeutralFill } from 'bootstrap-vue';

export default {
  data(){
    return{
      All_Organizers :'',
      All_Users :'',
      E_Not_Accepted :'',
      E_Accepted :'',
      stat_1 :'Users',
      stat_2 :'Organizers',
      stat_3:'Events Accepted',
      stat_4 :'Events Not Accepted',      
      table1:true,
      table2:false,
      table3:false,
      selectedOption: 'Categories',
      Form : false,
      newCategoryName: '',
      categories :'',
      editingCategoryId: null,
    }
  },
  components : {
    cart,
    smallNav,
    upload,
    users,
    events
  },
  updated() {
    // Check if the radio buttons are checked
    if (this.$refs.radio2.checked) {
      this.table2 = true ;
      this.table1 = false ;
      this.table3 = false ;
    } 
   else if (this.$refs.radio1.checked) {
      this.table2 = false ;
      this.table1 = true ;
      this.table3 = false ;
    } 
    else if (this.$refs.radio3.checked){
      this.table2 = false ;
      this.table1 = false ;
      this.table3 = true ;

      
    } 
  },
  methods:{
    handleAdd(){
      this.editingCategoryId = null;
      this.newCategoryName  = null;
      this.showForm();

    },
      showForm(){
        this.Form = !this.Form;
        },
      async fetchCategories() {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.get('http://127.0.0.1:8000/api/index-category');
          this.categories = response.data.categories;
        } catch (error) {
          console.error('Error from categories:', error);
        }
      },
      async addCategory() {
          try {
            const accessToken = localStorage.getItem('accessToken');
            axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
            const response = await axios.post('http://127.0.0.1:8000/api/store-category', {
              name: this.newCategoryName,
            });
            this.fetchCategories();
            this.showForm(); 
          } catch (error) {
            console.error('Error adding category:', error);
          }
      },
       editCategory(category) {
        this.newCategoryName = category.name;
        this.editingCategoryId = category.id;
        this.showForm();
      },
      async handleCategory() {
        if (this.editingCategoryId) {
          await this.editExistingCategory();
        } else {
          await this.addCategory();
        }
        this.editingCategoryId = null;
       },
      async editExistingCategory() {
        try {
                const accessToken = localStorage.getItem('accessToken');
                axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
              const response = await axios.put(`http://127.0.0.1:8000/api/update-category`,
                {
                  name: this.newCategoryName,
                  id: this.editingCategoryId,
                }
          );
          this.fetchCategories();
          this.showForm();
        } catch (error) {
          console.error('Error editing category:', error);
        }
      },
      async deleteCategory(category) {
        try {
        const accessToken = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
        
        const response = await axios.delete('http://127.0.0.1:8000/api/destroy-category', {
          data: {
            id: category.id
          }
        });
        this.fetchCategories();
        } catch (error) {
          console.error('Error deleting category:', error);
        }
      },
      async fetchStatistics() {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.get('http://127.0.0.1:8000/api/admin-statistics');
          this.E_Accepted = response.data.eventsAccepted;
          this.E_Not_Accepted = response.data.eventsNotAccepted;
          this.All_Users = response.data.users;
          this.All_Organizers = response.data.organizers;
        } catch (error) {
          console.error('Error from categories:', error);
        }
      }
},
  mounted(){
      this.fetchCategories();
      this.fetchStatistics();
  }}
    


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
    width: 40% !important;
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
.flx{
  justify-content: center;

}
.form label{
  width: 100% !important;
}
th:first-child, td:first-child{
  padding-left: 20px !important;
}
</style>
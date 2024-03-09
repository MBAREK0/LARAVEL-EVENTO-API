<template>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-white ">author</th>
                                  <th scope="col" class="text-white ">title</th>
                                  <th scope="col" class="text-white ">description</th>
                                  <th scope="col" class="text-white ">date</th>
                                  <th scope="col" class="text-white ">place</th>
                                  <th scope="col" class="text-white ">prix</th>
                                  <th scope="col" class="text-white ">N° places</th>
                                
                                  <th scope="col" class="text-white"></th>
                                  <th scope="col" class="text-white"></th>
                              </tr>
                          </thead>
                          <tbody v-if="Events">
                             <tr v-for="event in Events" :key="event.id">
                              <td>
                                <span class="mb-0">{{ event.author }}</span>
                              </td>
                              <td>
                                <span class="mb-0">{{ event.title }}</span>
                              </td>
                              <td>
                               
                                  <span class="mb-0"> {{ event.description }}</span>
                              </td>
                              <td>
                                <span class="mb-0">{{ event.date }}</span>
                              </td>
                              <td>
                                <span class="mb-0">{{ event.place }}</span>
                              </td>
                              <td>
                                <span class="mb-0">{{ event.prix }}</span>
                              </td>
                              <td>
                                <span class="mb-0">{{ event.number_places }}</span>
                              </td> 
                                                                            
                              <td class="align-middle text-center">
                              <h6 class="m-0 accept" @click="acceptEvent(event.id)"> Accept</h6>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
        Events:'',
        }
    },
    methods:{
    async fetchEvents() {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.get('http://127.0.0.1:8000/api/get-events');
          this.Events = response.data.Events;
        } catch (error) {
          console.error('Error from categories:', error);
        }
      },
    async acceptEvent(id) {
        try {
                const accessToken = localStorage.getItem('accessToken');
                axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
              const response = await axios.put(`http://127.0.0.1:8000/api/accept-event`,
                {
                
                  id: id
                }
          );
          this.fetchEvents();
        } catch (error) {
          console.error('Error editing category:', error);
        }
      },

    },
    beforeMount(){
        this.fetchEvents();
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
.table span,a,p,span{
   font-size: 16px !important;
     color: #fff;
     margin: 0;

   
}

.removable{
   margin-bottom: 5rem;
}
th:first-child, td:first-child{
  padding-left: 20px !important;
  width: 25% !important;
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
.form label{
    width: 100%;
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

.flx{
  justify-content: center;

}
.accept{
    color: #0087cc !important;
    cursor: pointer;
}
</style>
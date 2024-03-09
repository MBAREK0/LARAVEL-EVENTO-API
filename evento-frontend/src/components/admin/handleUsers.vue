<template>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive">
                      <table class="table table-striped table-hover">
                          <thead>
                              <tr>
                                  <th scope="col" class="text-white ">First Name</th>
                                  <th scope="col" class="text-white ">Last Name</th>
                                  <th scope="col" class="text-white ">Email</th>
                                  <th scope="col" class="text-white"></th>
                                  <th scope="col" class="text-white"></th>
                              </tr>
                          </thead>
                          <tbody>
                             <tr v-for="user in Users" :key="user.id">
                              <td>
                                <h6 class="mb-0">{{ user.firstName }}</h6>
                              </td>
                              <td>
                                <h6 class="mb-0">{{ user.lastName }}</h6>
                              </td>
                              <td>
                                <h6 class="mb-0">{{ user.email }}</h6>
                              </td>
                              <td class="align-middle text-center">
                               <button @click="handleForm(user)" >change permission</button>
                              </td>
                              <td class="align-middle text-center">
                                <button @click="deleteUser(user)">Delete</button>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
        <form class="form" v-if="showModel"  @submit.prevent="editUserRole">
            <p class="message">Add new category</p>
            <div class="flex">
                <label>
                    <span>the user role </span>
                    <select name="" class="input" id="" v-model="roleID">
                        <option :value="role.id" v-for="role in Roles" :key="role.id">{{ role.name }}</option>
                    </select>
                </label>
                <input class="input" type="text" placeholder=""  v-model="userID" hidden>
            </div> 
            <button class="submit">Update Role</button>
            <button class="anuler" @click="showForm">Cancel</button>
        </form>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
        Users:'',
        Roles:'',
        roleID:'',
        userID:'',
        showModel:false

        }
    },
    methods:{
    async fetchUsers() {
        try {
          const accessToken = localStorage.getItem('accessToken');
          axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
          const response = await axios.get('http://127.0.0.1:8000/api/get-users');
          this.Users = response.data.users;
          this.Roles = response.data.roles;
        } catch (error) {
          console.error('Error from categories:', error);
        }
      },
    async editUserRole() {
        try {
                const accessToken = localStorage.getItem('accessToken');
                axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
              const response = await axios.put(`http://127.0.0.1:8000/api/update-role`,
                {
                  role_id: this.roleID,
                  id: this.userID
                }
          );
          this.fetchUsers();
          this.showform();
        } catch (error) {
          console.error('Error editing category:', error);
        }
      },
      async deleteUser(user) {
        try {
        const accessToken = localStorage.getItem('accessToken');
        axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
        
        const response = await axios.delete('http://127.0.0.1:8000/api/destroy-user', {
          data: {
            id: user.id
          }
        });
        this.fetchUsers();
        } catch (error) {
          console.error('Error deleting category:', error);
        }
      },
      handleForm(user){
        this.roleID = user.role_id;
        this.userID = user.id;
        this.showform();

      },
      showform(){
        this.showModel = !this.showModel;
      }

    },
    beforeMount(){
        this.fetchUsers();
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
th:first-child, td:first-child{
  padding-left: 20px !important;
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
</style>
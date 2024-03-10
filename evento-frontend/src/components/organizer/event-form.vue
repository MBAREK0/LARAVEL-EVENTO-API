<template>
  <smallNav />
  <main class="s-home s-home--slides info-is-visible">
    <div class="home-content">
      <div class="row home-content__main">
        <form class="form" @submit.prevent="submitEvent">
          <p class="title">Add New Event </p>
          <div class="flex">
            <label>
              <input class="input" type="text" v-model="title" placeholder="" required />
              <span>Title</span>
            </label>
            <label>
              <select class="input" v-model="type_reserved">
                <option value="manuel" selected>manuel</option>
                <option value="automatic">automatic</option>
              </select>
              <span>type of reserved</span>
            </label>
          </div>
          <label>
            <select name="" class="input" v-model="id_categorie">
              <option :value="event.id_categorie">{{ event.category }}</option>
              <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
            </select>
            <span>category</span>
          </label>
          <label>
            <textarea class="input" v-model="description" required></textarea>
            <span>description</span>
          </label>
          <label>
            <input class="input" type="date" v-model="date" required />
            <span>date</span>
          </label>
          <label>
            <input class="input" type="text" v-model="place" required />
            <span>place </span>
          </label>
          <label>
            <input class="input" type="number" v-model="prix" required />
            <span>price <small>Please enter a valid number</small></span>
          </label>
          <label>
            <input class="input" type="number" v-model="number_places" required />
            <span>number of places <small>Please enter a valid number</small></span>
          </label>
          <label>
            <input class="input" type="text" v-model="instagram" required />
            <span>instagram Link</span>
          </label>
          <label>
            <input class="input" type="text" v-model="facebook" required />
            <span>facebook Link</span>
          </label>
          <label>
            <input class="input" type="text" v-model="twitter" required />
            <span>twitter Link</span>
          </label>
          <label >
            <img :src="fullImagePath()"  width="50%" alt="img">
          </label>
          <input type="file" @change="handleFileChange" />
          <div v-if="validationError" class="alert alert-danger op">
            {{ validationError }}
          </div>
          <button class="submit">POST</button>
          <button class="anuler" @click="showForm">cancel</button>
        </form>
      </div>
    </div>
  </main>
</template>

<script>
import smallNav from '../user/nav/nav.vue';
import axios from 'axios';

export default {
  data() {
    return {
      validationError: '',
      table1: true,
      table2: false,
      selectedOption: 'Next',
      Form: false,
      categories: '',
      title: '',
      description: '',
      number_places: '',
      place: '',
      prix: '',
      date: '',
      type_reserved: '',
      id_categorie: '',
      instagram: '',
      facebook: '',
      twitter: '',
      selectedFile: '',
      event: '',
      id_categorie: '',
      type_reserved: '',
    };
  },

  components: {
    smallNav,
  },
  methods: {
    async submitEvent() {
      let imagePath ='';
      if (this.selectedFile) {
       imagePath = await this.uploadImageFile(this.selectedFile);
      }else{
       imagePath =  this.event.image_path;
      }
      try {
        const response = await axios.put('http://127.0.0.1:8000/api/update-event', {
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
          id:this.event.id

        });
        console.log('Event updated successfully:', response.data);
      } catch (error) {
        if (error.response && error.response.status === 422) {
          const validationError = error.response.data.errors;
        } else {
          console.error('Error:', error.message);
        }
      }
      this.$router.push('/organizer');
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
    fullImagePath() {
      return `http://127.0.0.1:8000/storage/${this.event.image_path}`;
    }
  },
  mounted() {
    this.event = JSON.parse(this.$route.query.data);
    this.id_categorie = this.event.id_categorie;
    this.type_reserved = this.event.type_reserved;
    this.title = this.event.title;
    this.description = this.event.description;
    this.number_places = this.event.number_places;
    this.place = this.event.place;
    this.prix = this.event.prix;
    this.date = this.event.date;
    this.instagram = this.event.instagram;
    this.facebook = this.event.facebook;
    this.twitter = this.event.twitter;
  },
};
</script>

<style scoped>
.row {
  width: 100%;
  display: flex;
  justify-content: space-around;
  max-width: none;
}
.main-content {
  margin-top: 9rem;
}
.table {
  background-color: black;
  color: #fff;
}
.table span,
a,
p,
h6 {
  font-size: 16px !important;
  color: #fff;
  margin: 0;
}
.removable {
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
  border: 5px solid #00bfff96;
  color: #00bfff96;
}
.radio-button__input:checked + .radio-button__label {
  color: #00bfff96;
}
.radio-button__label:hover .radio-button__custom {
  transform: translateY(-50%) scale(1.2);
  border-color: #00bfff96;
  box-shadow: 0 0 10px #4c8bf580;
}
.hello {
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
.form {
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 800;
  width: 85% !important;
}
.anuler {
  border: 1px solid #0087cc;
  outline: none;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
  background-color: transparent;
}
.upload-image {
  color: rgba(255, 255, 255, 0.5);
}
html.ss-loaded .home-content__main {
  display: flex;
  justify-content: center;
}
</style>

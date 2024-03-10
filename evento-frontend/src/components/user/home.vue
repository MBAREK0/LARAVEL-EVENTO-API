<template>
 
    <!-- header 
    ================================================== -->
    <header id="sildes">
            <bigNav @search="handleSearch" />         	
    </header>
    <!-- end header -->
    <main class="home">
        <div class=" main-event">
            <img src="https://media.istockphoto.com/id/499517325/photo/a-man-speaking-at-a-business-conference.jpg?s=612x612&w=0&k=20&c=gWTTDs_Hl6AEGOunoQ2LsjrcTJkknf9G8BGqsywyEtE="  alt="...">
            <div>
                <h3>this is a title</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque esse quae reiciendis suscipit. Deleniti dolores ad soluta sunt illo adipisci magnam tempore sit iusto obcaecati consequatur, corporis nostrum provident nihil.</p>
            </div>
        </div>

    <div class="row container">

        <div class="flxbox">
            <div class="radio-button">
                <input
                name="radio-group"
                id="radioNocategory"
                class="radio-button__input"
                type="radio"
                v-model="selectedCategory"
                value=""
                />
                <label for="radioNocategory" class="radio-button__label">
                <span class="radio-button__custom"></span>
                No Category
                </label>
            </div>
            <div class="radio-buttons-container" v-for="category in categories" :key="category.id">
                <div class="radio-button">
                    <input
                    name="radio-group"
                    :id="`radio${category.id}`"
                    class="radio-button__input"
                    type="radio"
                    v-model="selectedCategory"
                    :value="category.id"
                    :ref="category.name"
                    />
                    <label :for="`radio${category.id}`" class="radio-button__label">
                    <span class="radio-button__custom"></span>
                    {{ category.name }} 
                    </label>
                    
                </div>
            </div>
        </div>

            <div class="block-1-3 block-m-1-2 block-tab-full">
     
                <div class="col-block entry" v-for="event in events" :key="event.id">
                    <div>
                       <router-link :to="{ name: 'event',query: { data: JSON.stringify(event) } }" >
                        <event :event="event" />
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>{{ event.title }}</h3>
                    </div>
                </div>
              
            </div>
        </div>

        <div>
            <div class="page-info">
                Showing 1 of {{ totalPages }}
            </div>
            <button @click="page(1)" :class="{ 'paginate-active': pageNumber === 1 }" class="paginate">First</button>
            <button v-for="pageNumber in totalPages" :key="pageNumber" @click="page(pageNumber)" :class="{ 'paginate-active': pageNumber === currentPage }" class="paginate">
                {{ pageNumber }}
            </button>
            <button @click="page(totalPages)" :class="{ 'paginate-active': pageNumber === totalPages }" class="paginate">Last</button>
        </div>
    </main> 
    <foooter/>
      <div>

  </div>
</template>

<script>
import event from './cards/eventCard.vue';
import bigNav from './nav/bignav.vue';
import foooter from './nav/footer.vue';
import axios from 'axios';

export default {
  components: {
    event,
    bigNav,
    foooter,
  },
  data() {
    return {
      events: [],
      categories: [],
      receivedSearchQuery: "",
      selectedCategory: '',
      totalPages:'',
      pageNumber:1,
      currentPage: 1, 
    };
  },
  methods: {
    handleSearch(query) {
      this.receivedSearchQuery = query;
      this.fetchData();
      this.scrollDown();
    },
    async fetchData() {
      const apiUrl = 'http://127.0.0.1:8000/api/home-events';
  
      try {
        const response = await axios.post(apiUrl, { 
            search: this.receivedSearchQuery,
            category: this.selectedCategory,
            pageNumber:this.pageNumber
         });
        this.events = response.data.Events;
        this.categories = response.data.categories;
        this.totalPages = response.data.pages;
        console.log(response.data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    scrollDown() {
      window.scrollBy({
        top: 1000, 
        behavior: 'smooth', 
      });
    },
    page(page){
        this.pageNumber = page ;
         this.currentPage = page;
        this.fetchData();
    }
  },
  mounted() {
    this.fetchData();
  },
  updated() {
    console.log('category',this.selectedCategory)
    console.log('search',this.receivedSearchQuery)
  },
  watch: {
    selectedCategory: 'fetchData',  
  },
};
</script>


<style scoped>

main .entry__title{
    padding-top: 0;
}
#slides{
    background-image: url('https://dojotaku.com/cdn/shop/articles/luffy-age.webp?v=1686482098');
    width: 100%;
    height: 100%;
}
.main-event{
    width: 100%;
    margin: 5rem 0 ;
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding-right: calc(1.5rem * .5);
  padding-left: calc(1.5rem * .5);
  gap: 10px;
}
.main-event img {
    width: 50% !important;
    border-radius: 10px;
}
.main-event div{
width: 42%;
}
.main-event div h3{
    color: #fff;
    margin:0;
}
@media  screen  and (max-width: 1111px) {
    .main-event{
        flex-direction: column;
    }
    .main-event img{
        width: 90% !important;
    }
    .main-event div{
        width: 85%;
        }
}
.row {
  width: 100%;
  max-width: none;
  margin: 0 ;
}

.removable{
   margin-bottom: 5rem;
}
.radio-buttons-container {
  display: flex;
  align-items: center;
  gap: 24px;
  margin: 0 !important;
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
  margin-bottom: 0;
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
.flxbox{
    padding: 20px;
    display: flex;
    justify-content:flex-start;
    align-items: center !important;
    flex-wrap:wrap;
    gap: 20px;
    }

    .paginate{
        background-color: transparent;
        border: 1px solid #4c8bf580;
        color: #fff;
    }
    .paginate:hover,.paginate:focus{
        background-color: #4c8bf580;
    }
    .paginate-active{
        background-color: #4c8bf580 !important;
    }
</style>
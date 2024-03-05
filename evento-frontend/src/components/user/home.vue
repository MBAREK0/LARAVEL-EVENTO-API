<template>
 
    <!-- header 
    ================================================== -->
    <header id="sildes">
            <bigNav/> 
           	
    </header>
    <!-- end header -->

    <!-- main content
    ================================================== -->
    <main class="home">
        <div class=" main-event">
            <img src="https://media.istockphoto.com/id/499517325/photo/a-man-speaking-at-a-business-conference.jpg?s=612x612&w=0&k=20&c=gWTTDs_Hl6AEGOunoQ2LsjrcTJkknf9G8BGqsywyEtE="  alt="...">
            <div>
                <h3>this is a title</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque esse quae reiciendis suscipit. Deleniti dolores ad soluta sunt illo adipisci magnam tempore sit iusto obcaecati consequatur, corporis nostrum provident nihil.</p>
            </div>
        </div>
        <div class="row container">
            <div class="block-1-3 block-m-1-2 block-tab-full">
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
                <div class="col-block entry">
                    <div>
                       <router-link :to="{ name: 'event' }" >
                        <event/>
                        </router-link>
                    </div>
                    <div class="entry__title">
                        <h3>Static Background</h3>
                    </div>
                </div>
            </div>
        </div>
    </main> <!-- /main -->
    <foooter/>
    <!-- preloader
    ================================================== -->

</template>

<script>
import event from './cards/eventCard.vue'
import bigNav from './nav/bignav.vue'
import foooter from './nav/footer.vue'
export default {
 components : {
    event,
    bigNav,
    foooter
 }
}
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
</style>
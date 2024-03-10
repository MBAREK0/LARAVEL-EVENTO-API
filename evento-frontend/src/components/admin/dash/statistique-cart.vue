<template>
    <div class="col-xl-3 col-sm-6">
        <div class="card static-cart mb-4">
            <div class="card-body p-3">
                <div class="row">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize text-white font-weight-bold">{{ EventStatus }} : </p>
                            <h5 class="font-weight-bolder text-white mb-0">
                               {{statistics}}
                            </h5>
                        </div>    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    statistics: {
      type: Number, 
      required: true,
    },
    EventStatus:{
        type: String, 
      required: true,
    }
  },
};
</script>

<style scoped>
.numbers{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
}

.numbers p{
    font-size: 20px !important;
}
.static-cart{
background-color: black !important;
border: 1px solid #00bfff96 !important;
border-radius: 16px;
}
.static-cart:hover{
    background-color: #00bfff96 !important;

}
h5{
     margin: 0 !important;

}
</style>
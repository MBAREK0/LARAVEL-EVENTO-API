<template>
  
  <router-view/>
  
</template>
<script>
  
  window.$ = window.jQuery = require("@/assets/js/jquery-3.2.1.min.js");
  require("@/assets/js/modernizr.js")
  require("@/assets/js/pace.min.js")
  require("@/assets/js/plugins.js")
  require("@/assets/js/main.js")

</script>

<style>
    @import '@/assets/css/base.css';
    @import '@/assets/css/demo.css';
    @import '@/assets/css/vendor.css';
    @import '@/assets/css/app.css';
    @import '@/assets/css/main.css'; 

.modal-form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    z-index: 800;
    width: 50% !important;
 
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
.flex label {
    width: 50%;
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
@media (min-width: 800px) {
 .home-content__main{
    display: flex;
    justify-content: center;
    align-items: center;

 }
 .form{
    widows: 70%;
 }
}
.upload{
    color:rgba(255, 255, 255, 0.5);
    text-align: left;
    margin: 0 !important;
    font-weight: 100;
    font-size: large;
}
.flex-upload{
    display: flex;
    justify-content: space-between;
    align-items: center;

}
    .add-btn {
  background-color: #fff;
  border: 1px solid #0077b5;
 height: 45px;
  padding: 0 19px;
  margin: 0;

  border-radius: 0.4em;
  color: #0077b5;
}

.add-btn:hover {
  background-color: #0077b5;
  color: #fff;

}
.flxbox{
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
  flex-wrap: wrap;
}
.op{
    opacity: 0.4 !important;
    background-color: #760064 !important;
    color: aliceblue !important;
}
.os{
    opacity: 0.4 !important;
    background-color: #186592 !important;
    color: aliceblue !important;
}
</style>

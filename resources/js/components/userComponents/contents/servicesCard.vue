<template>
    <div v-for="service in services" :key="service.id" class="service-card">
      <div class="arch-frame">
        <img :src="`/storage/${service.image}`" alt="Service Image" />
      </div>
      <div class="serviceDetails-con">
        <p class="service-name">{{ service.serviceName }}</p>
        <p class="servicePrice">P {{ service.price }}</p>
        <button @click="bookService(service)">Book Now</button>
      </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  services: { type: Array, required: true },
});

const emits = defineEmits(['serviceSelected']);

const bookService = (service) => {
  emits('serviceSelected', service);
};
</script>

  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

  
  .service-card {
    width: 160px;
    height: 200px;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease-in-out;
  }

  .arch-frame {
    width: 150px; 
    height: 150px; 
    overflow: hidden;
    position: relative;
    background: beige;
    border-radius: 200px 200px 0 0 / 200px 200px 0 0;
    border: #465048 solid 2px;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
  }

  .arch-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .serviceDetails-con{
    width: 80%;
    height: 35%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
    background-color: #986D4D;
    border-bottom-left-radius: 25px;
    border-bottom-right-radius: 25px;
    border: #986D4D solid 2px;
  }
  .service-name {
    color: white;
    margin: 0;
    font-size: 1rem;
    font-family: 'playfair display', serif;
    font-weight: 600;
    text-align: center;
  }
  .servicePrice {
    color: #543727;
    font-size: 1rem;
    margin: 2px;
    font-family: 'inter', sans-serif;
    font-weight: 800;

  }
  .serviceDetails-con button{
    width: 50%;
    height: 25px;
    border: none;
    border-radius: 20px;
    background-color: #543727;
    color: white;
    font-size: .8rem;
    cursor: pointer;
    margin: 2px;
    font-weight: bold;
  }
  .serviceDetails-con button:hover{
    background-color: #f0f0f0;
    color: #543727;
    border: 2px solid #543727;
  }
  </style>
  
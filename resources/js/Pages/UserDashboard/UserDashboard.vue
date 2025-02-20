<template>
  <div class="user-body">
    <Header 
      @showProfile="showProfile" 
      @showSettings="showSettings" 
      :notifications="unreadNotifications"
      @backToDashboard="backToDashboard"
    />
    
    <!-- Main content view -->
    <main v-if="!viewingServices && !viewingBooking && !viewingProfile && !viewingSettings">
      <!-- Main content (categories) here -->
      <button class="slide-button" @click="prevSlide"> ‹ </button>
      <div class="card-container">
        <categoryCard :categories="visibleCategories" @categorySelected="showServices" />
      </div>
      <button class="slide-button" @click="nextSlide">
        ›
      </button>
    </main>

    <div class="viewServices" v-if="viewingServices && !viewingBooking && !viewingProfile && !viewingSettings">
      <div class="vsHeader">
        <button class="back-button" @click="backToMain"></button>
        <h2 class="manage">{{ selectedCategoryName }}</h2>
      </div>
      <div class="vsMain">
        <button class="slide-button" @click="prevServiceSlide"> ‹ </button>
        <div class="card-container">
          <servicesCard :services="filteredServices" @serviceSelected="showBooking" />
        </div>
        <button class="slide-button" @click="nextServiceSlide">
          ›
        </button>
      </div>
    </div>

    <!-- Booking view -->
    <bookingForm v-if="viewingBooking && !viewingProfile && !viewingSettings" :service="selectedService" @backToServices="backToServices" />

    <!-- User Profile view -->
    <userProfile v-if="viewingProfile && !viewingSettings" @backToPrevious="backToPrevious" :customer="customer" @updateCustomer="updateCustomer" />

    <!-- Settings view -->
    <settings v-if="viewingSettings" @goBack="goBack" :upcomingAppointments="upcomingAppointments" :todaysAppointments="todaysAppointments" :historyAppointments="historyAppointments"/>

    <Footer />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Header from '../../components/userComponents/userHeader.vue';
import Footer from '../../components/userComponents/userFooter.vue';
import categoryCard from '../../components/userComponents/contents/categoryCard.vue';
import servicesCard from '../../components/userComponents/contents/servicesCard.vue';
import bookingForm from '../../components/userComponents/contents/bookingForm.vue';
import userProfile from '../../components/userComponents/contents/userProfile.vue';
import settings from '../../components/userComponents/contents/settings.vue';

const props = defineProps({
  categories: { type: Array, required: true },
  services: { type: Array, required: true },
  appointments: { type: Array, required: true },
  customer: { type: Object, required: true },
  upcomingAppointments: Array,
  todaysAppointments: Array,
  historyAppointments: Array,
  unreadNotifications: Array,
});

const currentSlide = ref(0);
const currentServiceSlide = ref(0);
const visibleCount = 4;
const viewingServices = ref(false);
const viewingBooking = ref(false);
const viewingProfile = ref(false);
const viewingSettings = ref(false);

const selectedCategoryId = ref(null);
const selectedCategoryName = ref('');
const selectedService = ref({});

const visibleCategories = computed(() => {
  const totalCategories = props.categories.length;
  const startIndex = currentSlide.value;
  
  // Always ensure 4 items are shown
  return [
    props.categories[(startIndex + 0) % totalCategories],
    props.categories[(startIndex + 1) % totalCategories],
    props.categories[(startIndex + 2) % totalCategories],
    props.categories[(startIndex + 3) % totalCategories],
  ];
});

const filteredServices = computed(() => {
  const filtered = props.services.filter(service => service.categoryID === selectedCategoryId.value);
  const totalServices = filtered.length;
  const startIndex = currentServiceSlide.value;
  
  // Always ensure 4 items are shown
  return [
    filtered[(startIndex + 0) % totalServices],
    filtered[(startIndex + 1) % totalServices],
    filtered[(startIndex + 2) % totalServices],
    filtered[(startIndex + 3) % totalServices],
  ];
});

const prevSlide = () => {
  currentSlide.value = (currentSlide.value === 0) ? props.categories.length - 1 : currentSlide.value - 1;
};

const nextSlide = () => {
  currentSlide.value = (currentSlide.value === props.categories.length - 1) ? 0 : currentSlide.value + 1;
};

const prevServiceSlide = () => {
  currentServiceSlide.value = (currentServiceSlide.value === 0) ? filteredServices.value.length - 1 : currentServiceSlide.value - 1;
};

const nextServiceSlide = () => {
  currentServiceSlide.value = (currentServiceSlide.value === filteredServices.value.length - 1) ? 0 : currentServiceSlide.value + 1;
};

const showServices = (category) => {
  selectedCategoryId.value = category.id;
  selectedCategoryName.value = category.categoryName;
  viewingServices.value = true;
};

const showProfile = () => {
  viewingProfile.value = true;
  viewingSettings.value = false; // Ensure settings is hidden
};

const showBooking = (service) => {
  selectedService.value = service;
  viewingBooking.value = true;
};

const showSettings = () => {
  viewingSettings.value = true;
  viewingProfile.value = false;
  viewingServices.value = false;
  viewingBooking.value = false;
};

const backToServices = () => {
  viewingBooking.value = false;
};

const backToMain = () => {
  viewingServices.value = false;
  viewingBooking.value = false;
  currentServiceSlide.value = 0;
};

const backToPrevious = () => {
  viewingProfile.value = false;
};

const goBack = () => {
  viewingSettings.value = false;
};

const backToDashboard = () => {
  viewingSettings.value = false;
  viewingProfile.value = false;
  viewingServices.value = false;
  viewingBooking.value = false;
};

const updateCustomer = (updatedCustomer) => {
  props.customer.firstName = updatedCustomer.firstName;
  props.customer.lastName = updatedCustomer.lastName;
  props.customer.email = updatedCustomer.email;
  props.customer.contactNumber = updatedCustomer.contactNumber;
};
</script>


<style scoped>
.user-body {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background-image: url("/image/main-background.png");
  background-size: cover;
}

.back-button {
  width: 55px;
  height: 55px;
  border-radius: 50%;
  cursor: pointer;
  background-image: url('/public/image/back (2).png');
  background-size: cover;
  background-position: center;
  border: none;
}

.manage {
  font-size: 2.8em;
  font-weight: bold;
  color: black;
  margin: 0;
  font-family: 'playfair display', serif;
  font-style: italic;
  position: absolute;  
  top: 12%;
  left: 15%;
}
  
main {
  width: 100%;
  height: 80%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.card-container {
  width: 70%;
  height: 100%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 20px;
  overflow: hidden;
  position: relative;
  transition: transform 1.5s ease-in-out, opacity 0.3s ease;
}

.card-container > * {
  flex: 0 0 calc(20% - 20px); 
}

.slide-button {
  background-color: #986d4d;
  color: white;
  font-size: 2em;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.slide-button:hover:not(:disabled) {
  background-color: #b9855f;
  transform: scale(1.1);
}

.slide-button:disabled {
  background-color: #d6c3b7;
  cursor: not-allowed;
  box-shadow: none;
}

.viewServices {
  width: 100%;
  height: 80%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.vsHeader {
  width: 80%;
  height: 20%;
}

.vsMain {
  width: 100%;
  height: 80%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 10px;
}
</style>

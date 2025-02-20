<template>
  <div class="sidebar">
    <div class="sidebar-logo">
      <img src="/public/image/radiant-white.png" alt="image" />
    </div>
    <div class="profile-con">
      <img src="/public/image/person (1).png" alt="image" />
      <h2>ADMIN</h2>
      <p>System Administration</p>
    </div>
    <div class="navbar">
      <button 
        class="nav-btn" 
        :class="{ active: activeMenu === 'dashboard-main' }" 
        @click="showContent('dashboard-main')">
        <img src="/public/image/dashboard-icon.png" alt="icon" /> Dashboard
      </button>

      <div class="dropdown" :class="{ open: isOpen.category }">
        <button 
          class="dropdown-btn" 
          :class="{ active: activeMenu === 'add-category-main' || activeMenu === 'manage-category-main' }" 
          @click="toggleDropdown('category')">
          <img src="/public/image/services-icon.png" alt="icon" /> Category
        </button>
        <div class="dropdown-content">
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'add-category-main' }" 
            @click="showContent('add-category-main')">
            <span class="bullet">•</span> Add Category
          </button>
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'manage-category-main' }" 
            @click="showContent('manage-category-main')">
            <span class="bullet">•</span> Manage Category
          </button>
        </div>
      </div>

      <div class="dropdown" :class="{ open: isOpen.services }">
        <button 
          class="dropdown-btn" 
          :class="{ active: activeMenu === 'add-service-main' || activeMenu === 'manage-service-main' }" 
          @click="toggleDropdown('services')">
          <img src="/public/image/services-icon.png" alt="icon" /> Services
        </button>
        <div class="dropdown-content">
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'add-service-main' }" 
            @click="showContent('add-service-main')">
            <span class="bullet">•</span> Add Services
          </button>
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'manage-service-main' }" 
            @click="showContent('manage-service-main')">
            <span class="bullet">•</span> Manage Services
          </button>
        </div>
      </div>

      <div class="dropdown" :class="{ open: isOpen.customers }">
        <button 
          class="dropdown-btn" 
          :class="{ active: activeMenu === 'manage-customer-main' || activeMenu === 'blocked-customer-main' }" 
          @click="toggleDropdown('customers')">
          <img src="/public/image/management.png" alt="icon" /> Manage Customers
        </button>
        <div class="dropdown-content">
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'manage-customer-main' }" 
            @click="showContent('manage-customer-main')">
            <span class="bullet">•</span> Customer List
          </button>
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'blocked-customer-main' }" 
            @click="showContent('blocked-customer-main')">
            <span class="bullet">•</span> Blocked Customers
          </button>
        </div>
      </div>

      <div class="dropdown" :class="{ open: isOpen.appointments }">
        <button 
          class="dropdown-btn" 
          :class="{ active: activeMenu === 'manage-appointment-main' || activeMenu === 'add-appointment-main' }" 
          @click="toggleDropdown('appointments')">
          <img src="/public/image/appointment.png" alt="icon" /> Appointments
        </button>
        <div class="dropdown-content">
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'add-appointment-main' }" 
            @click="showContent('add-appointment-main')">
            <span class="bullet">•</span> Add Appointments
          </button>
          <button 
            class="dropdown-option" 
            :class="{ active: activeMenu === 'manage-appointment-main' }" 
            @click="showContent('manage-appointment-main')">
            <span class="bullet">•</span> Manage Appointments
          </button>
          
        </div>
      </div>
    </div>
    <div class="logout-con">
      <button @click.prevent="handleLogout"><img src="/public/image/logout-icon.png" alt="icon" /> Logout</button>
    </div>
  </div>
</template>

<script setup>
import { reactive, defineEmits, defineProps } from 'vue';
import axios from 'axios';

const props = defineProps({
  activeMenu: String,
});

const emit = defineEmits(['show-content']);

const isOpen = reactive({
  category: false,
  services: false,
  customers: false,
  appointments: false,
});

function toggleDropdown(menu) {
  isOpen[menu] = !isOpen[menu];

  Object.keys(isOpen).forEach((key) => {
    if (key !== menu) {
      isOpen[key] = false;
    }
  });
}

function showContent(target) {
  emit('show-content', target);
}
const handleLogout = async () => {
  try {
    await axios.post('/logout');
    window.location.href = '/login';
  } catch (error) {
    console.error('Logout failed:', error);
  }
};
</script>






<style scoped>
.sidebar{
    width: 20%;
    height: 100%;
    position: relative;
    background-color: #986D4D;
    box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
    z-index: 10;
    transition: all 0.3s ease;
}
.sidebar-logo{
    width: 100%;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.sidebar-logo img{
    width: 80%;
    height: auto;
}
.profile-con{
    width: 100%;
    height: 180px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.profile-con img{
    width: 100px;
    height: auto;
}
.profile-con h2{
    color: white;
    font-size: 1.5em;
    margin: 0;
}
.profile-con p{
    color: white;
    font-size: 1em;
    margin: 0;
}

.navbar {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-top: 10px;
}

.navbar button img {
    width: 20px;
    height: auto;
}

.nav-btn, .dropdown-btn {
    background: none;
    border: none;
    color: white;
    display: flex;
    align-items: center;
    padding: 12px 20px;
    width: 100%;
    text-align: left;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, padding 0.3s ease;  
}

.nav-btn:hover, .dropdown-btn:hover {
    background-color: #543A20; 
}

.nav-btn img, .dropdown-btn img {
    margin-right: 10px;
}

.dropdown {
    position: relative;
}

.dropdown-content {
    display: none;
    padding-left: 20px;
    padding-top: 5px;
}

.dropdown-content button {
    background: none;
    border: none;
    color: white;
    width: 100%;
    padding: 10px;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.dropdown-content .bullet {
    font-size: 18px;
    margin-right: 10px;
}

.dropdown-content button:hover {
    background-color: #3A2311;
    border-radius: 10px;
}

.dropdown-btn::after {
    content: "\276F";
    position: absolute;
    right: 10px;
    font-size: 12px;
    color: white;
}
.dropdown.open .dropdown-content {
    display: block;
}
.dropdown.open .dropdown-btn::after {
    content: "\276F"; 
    transform: rotate(90deg);
}
.nav-btn::before, .dropdown-btn::before { 
    position: absolute;
    left: -20px;
    color: white;
    font-size: 16px;
}
.logout-con{
    width: 100%;
    height: 40px;
    position: absolute;
    display: flex;
    bottom: 10px;
    align-items: center;
    justify-content: center;
}
.logout-con button{
    width: 60%;
    height: 90%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1em;
    background-color: #3D2818;
    border-radius: 20px;
    border: none;
    cursor: pointer;
}
.logout-con button img{
    width: 30px;
    height: auto;
}
.nav-btn.active, .dropdown-option.active {
  background-color: #543A20;

}
</style>
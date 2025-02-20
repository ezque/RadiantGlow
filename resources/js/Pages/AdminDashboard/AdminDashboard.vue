<template>
  <div class="admin-body">
    <AdminSidebar :active-menu="currentContent" @show-content="handleShowContent" />
    <div class="dashboard-main" v-if="currentContent === 'dashboard-main'">
      <DashboardMain 
        :customers="props.customers" 
        :appointments="props.appointments"
        :customerCount="customerCount" 
        :appointmentCount="appointmentCount"
        :appointmentsByDay="props.appointmentsByDay"
        :appointmentsByMonth="props.appointmentsByMonth"
        @show-content="handleShowContent"
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="add-category-main" v-if="currentContent === 'add-category-main'">
      <AddCategory 
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="manage-category-main" v-if="currentContent === 'manage-category-main'">
      <ManageCategory 
        :categories="props.categories" 
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="add-service-main" v-if="currentContent === 'add-service-main'">
      <AddService 
        :categories="props.categories" 
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="manage-service-main" v-if="currentContent === 'manage-service-main'">
      <ManageService 
        :categories="props.categories"
        :services="props.services"
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="manage-customer-main" v-if="currentContent === 'manage-customer-main'">
      <CustomerList 
        :customers="props.customers" 
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="blocked-customer-main" v-if="currentContent === 'blocked-customer-main'">
      <BlockedList 
        :customers="blockedCustomers"
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="add-appointment-main" v-if="currentContent === 'add-appointment-main'">
      <AddAppointments 
        :services="props.services" 
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
    <div class="manage-appointment-main" v-if="currentContent === 'manage-appointment-main'">
      <ManageAppointments 
        :appointments="props.appointments" 
        :unreadNotifications="props.unreadNotifications"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import AdminSidebar from '../../components/adminComponents/AdminSidebar.vue';
import DashboardMain from './content/DashboardMain.vue';
import AddService from './content/AddService.vue';
import ManageService from './content/ManageService.vue';
import AddAppointments from './content/AddAppointments.vue';
import ManageAppointments from './content/ManageAppointments.vue';
import CustomerList from './content/CustomerList.vue';
import BlockedList from './content/BlockedList.vue';
import AddCategory from './content/AddCategory.vue';    
import ManageCategory from './content/ManageCategory.vue';

const currentContent = ref('dashboard-main');

const props = defineProps({
  categories: { type: Array, required: true },
  services: { type: Array, required: true },
  customers: { type: Array, required: true },
  appointments: { type: Array, required: true },
  unreadNotifications: { type: Array, required: true },
  appointmentsByDay: { type: Array, required: true },
  appointmentsByMonth: { type: Array, required: true },
});

const customerCount = computed(() => props.customers.length);
const appointmentCount = computed(() => props.appointments.length);

const blockedCustomers = computed(() =>
  props.customers.filter(customer => customer.status === 'blocked')
);

function handleShowContent(target) {
  currentContent.value = target;
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
.admin-body {
    height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: row;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
}

.dashboard-main,.add-service-main, .manage-service-main, .manage-customer-main, .blocked-customer-main, 
.add-appointment-main, .manage-appointment-main, .add-category-main, .manage-category-main {
    width: 80%;
    height: 100%;
    background-image: url('/image/main-background.png');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    display: flex;
    flex-direction: column;
    padding: 20px;
    overflow: auto;
}
</style>
    
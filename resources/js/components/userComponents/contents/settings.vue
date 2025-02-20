<template>
    <div class="settings-main">
      <div class="buttons-con" v-if="!showChangePassword && !showManageAppointments">
        <div class="back-button-con">
          <a @click="goBack">
            <img src="/public/image/back (2).png" alt="back">
          </a>
        </div>
        <div class="settings-main-buttons-con">
          <a  href="#" @click.prevent="showComponent('changePassword')" class="change-password-button">
            <img src="/public/image/ChangePassword.png" alt="change password">
          </a>
          <a href="#" @click.prevent="showComponent('manageAppointments')" class="manage-appointments-button">
            <img src="/public/image/Appointments.png" alt="manage appointments">
          </a>
        </div>
        
      </div>
      <changePassword v-if="showChangePassword" @goBack="showBackButtons" />
      <manageAppoinments v-if="showManageAppointments" @goBack="showBackButtons" :upcomingAppointments="upcomingAppointments" :todaysAppointments="todaysAppointments" :historyAppointments="historyAppointments" />
    </div>
</template>
  
<script setup>
import { defineEmits, ref } from 'vue';
import changePassword from '../../userComponents/contents/changePassword.vue';
import manageAppoinments from '../../userComponents/contents/manageAppointments.vue';


const props = defineProps({
  upcomingAppointments: Array,
  todaysAppointments: Array,
  historyAppointments: Array,
});

const showChangePassword = ref(false);
const showManageAppointments = ref(false);

const emit = defineEmits(['goBack']);
const goBack = () => {
emit('goBack');
};



const showComponent = (component) => {
if (component === 'changePassword') {
    showChangePassword.value = true;
    showManageAppointments.value = false;
} else if (component === 'manageAppointments') {
    showChangePassword.value = false;
    showManageAppointments.value = true;
}
};

const showBackButtons = () => {
showChangePassword.value = false;
showManageAppointments.value = false;
};
</script>
  
<style scoped>
.settings-main {
  width: 100%;
  height: 80%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.buttons-con {
  width: 80%;
  height: 80%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.back-button-con {
  position: absolute; 
  top: 15%;
  left: 10%;
  padding: 10px;
}

.back-button-con a {
  display: flex;
  align-items: flex-start; 
  justify-content: flex-start; 
}

.back-button-con a img {
  width: 10%; 
  height: auto;
}

.settings-main-buttons-con {
  width: 80%;
  height: 20%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.settings-main-buttons-con a {
  width: 40%;
  height: 40%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.change-password-button img {
  width: 60%;
  height:auto;
}
.manage-appointments-button img {
  width: 62%;
  height: auto;
  margin-top: 10px;
}
</style> 
  
  
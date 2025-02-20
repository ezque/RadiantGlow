<template>
    <div class="change-password-main">
      <a @click="$emit('goBack')" class="back-button">
        <img src="/public/image/back (2).png" alt="back">
      </a>
      <img src="/public/image/ChangeYourPassword.png" alt="change password" class="change-password-image">
  
      <!-- Message Display -->
      <p v-if="message" :class="messageClass">{{ message }}</p>
  
      <!-- Change Password Form -->
      <form @submit.prevent="changePassword">
        <div class="form-input">
          <label for="oldPassword">Current password:</label><br>
          <input type="password" id="oldPassword" v-model="form.oldPassword" required />
        </div>
        <div class="form-input">
          <label for="newPassword">New password:</label><br>
          <input type="password" id="newPassword" v-model="form.newPassword" required />
        </div>
        <div class="form-input">
          <label for="confirmPassword">Repeat new password:</label><br>
          <input type="password" id="confirmPassword" v-model="form.newPassword_confirmation" required />
        </div>
        <button class="cancel" type="button" @click="$emit('goBack')">Cancel</button>
        <button class="save" type="submit">Save</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { reactive, ref } from 'vue';
  import { Inertia } from '@inertiajs/inertia';
  
  // Define props to handle the flash messages
  const props = defineProps({
    successMessage: String,
    errorMessage: String,
  });
  
  const form = reactive({
    oldPassword: '',
    newPassword: '',
    newPassword_confirmation: '',
  });
  
  const message = ref('');
  const messageClass = ref('');
  
  // Display success or error messages from flash session
  if (props.successMessage) {
    message.value = props.successMessage;
    messageClass.value = 'success';
  } else if (props.errorMessage) {
    message.value = props.errorMessage;
    messageClass.value = 'error';
  }
  
  const changePassword = () => {
    // Reset message before submitting
    message.value = '';
    messageClass.value = '';
  
    // Check if new password and confirm password match
    if (form.newPassword !== form.newPassword_confirmation) {
      message.value = 'New passwords do not match!';
      messageClass.value = 'error';
      return;
    }
  
    // Send password change request using Inertia
    Inertia.post('/change-password', form, {
      onSuccess: () => {
        message.value = 'Password changed successfully!';
        messageClass.value = 'success';
      },
      onError: (errors) => {
        const errorMessages = Object.values(errors).flat().join(', ');
        message.value = 'Password change failed: ' + errorMessages;
        messageClass.value = 'error';
      }
    });
  };
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.back-button {
  position: absolute;  
  top: 15%;
  left: 10%;
  display: flex;
  align-items: flex-start; 
  justify-content: flex-start; 
}

.back-button img {
  width: 10%; 
  height: auto;
}
.success {
  color: green;
}
  
.error {
  color: red;
}

.change-password-image { 
  width: 35%; 
  height: auto;
  position: absolute;
  top: 14%;
  left: 15%;
}
.change-password-main {
  width: 45%;
  height: 60%;
  margin-top: 30px;
}
label {
  font-family: 'playfair display', serif;
  font-weight: bold;
  font-style: italic;
  color: #465048;
  font-size: 23px;
  gap: 10px;
}
.form-input {
  width: 100%;
  height: 100%;
  margin-bottom: 15px;
}
.form-input input {
  width: 96%;
  height: 80%;
  border: none;
  outline: none;
  font-size: 18px;
  padding: 13px;
  background-color: #C0B283;
  opacity: 81%;
  border-radius: 15px;
  margin-left: 5px;
  color: #986D4D;
}

.cancel {
  width: 12%;
  height: 40px;
  border: none;
  background-color: #986D4D;
  opacity: 61%;
  color: white;
  border-radius: 20px;
  font-weight: bold;
  padding: 5px;
  position: relative;
  top: 10%;
  left: 73%;
}
.save {
  width: 12%;
  height: 40px;
  border: none;
  background-color: #465048;
  opacity: 81%;
  color: white;
  border-radius: 20px;
  font-weight: bold;
  padding: 5px;
  position: relative;
  top: 10%;
  left: 75%;
}
.cancel:hover {
  background-color: #543727;
  opacity: 100%;
}
.save:hover {
  background-color: #465048;
  opacity: 100%;
}
  </style>
  
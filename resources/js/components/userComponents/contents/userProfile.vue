<template>
    <div class="user-profile">
      <a @click="backToPrevious" class="back-button">
        <img src="/public/image/back (2).png" alt="back">
      </a>
      <h2>Profile</h2>
  
      <!-- Display the customer info or input fields -->
      <div v-if="customer">
        <div v-if="!editMode" class="profile-info">
          <div class="firstname-con">
             <label for="firstName">First Name:</label>
             <p>{{ customerData.firstName }}</p>
          </div>
          <div class="lastname-con">
            <label for="lastName">Last Name:</label>
            <p>{{ customerData.lastName }}</p>
          </div>
          <div class="email-con">
            <label for="email">Email:</label>
            <p>{{ customerData.email }}</p>
          </div>
          <div class="contact-con">
            <label for="contact">Contact:</label>
            <p>{{ customerData.contactNumber }}</p>
          </div>
          <button @click="toggleEditMode" class="edit-button">Edit</button>
        </div>
        <form v-else @submit.prevent="saveChanges">
          <h3>Edit Profile</h3>
          <p class="form">
            <label>
              <strong>First Name:</strong>
              <input v-model="customerData.firstName" type="text" required />
            </label>
          </p>
          <p class="form">
            <label>
              <strong>Last Name:</strong>
              <input v-model="customerData.lastName" type="text" required />
            </label>
          </p>
          <p class="form">
            <label>
              <strong>Email:</strong>
              <input v-model="customerData.email" type="email" required />
            </label>
          </p>
          <p class="form">
            <label>
              <strong>Contact:</strong>
              <input v-model="customerData.contactNumber" type="text" required />
            </label>
          </p>
          <div class="edit-cancel">
            <button class="save" type="submit">Save</button>
            <button class="cancel" type="button" @click="toggleEditMode">Cancel</button>
          </div>
        </form>
      </div>
      <div v-else>
        <p>No customer data available.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { defineEmits, defineProps } from 'vue';
  import axios from 'axios'; // Import Axios
  
  // Define props and emits
  const props = defineProps({
    customer: { type: Object, required: true },
  });
  const emit = defineEmits();
  
  // Reactive data
  const customerData = ref({ ...props.customer });
  const editMode = ref(false);
  
  // Go back to the previous page
  const backToPrevious = () => {
    emit('backToPrevious');
  };
  
  // Toggle edit mode
  const toggleEditMode = () => {
    editMode.value = !editMode.value;
    if (!editMode.value) {
      customerData.value = { ...props.customer };
    }
  };
  
  // Save changes using Axios
  const saveChanges = async () => {
    try {
      // Axios automatically handles CSRF if the token is present in the meta tag
      const response = await axios.post('/update-profile', customerData.value);
  
      // Emit the updated customer data back to the parent
      emit('updateCustomer', response.data);
  
      // Exit edit mode
      toggleEditMode();
    } catch (error) {
      console.error('Error updating customer data:', error);
    }
  };
  </script>
  
  
  
<style scoped>
.user-profile {
  width: 30%;
  margin: 0 auto;
}
button {
  margin-right: 10px;
}
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
input {
  width: 100%;
  padding: 5px;
  margin-bottom: 10px;
}
.user-profile h2 {
  font-size: 2.5em;
  font-weight: bold;
  color: black;
  margin: 0;
  font-family: 'playfair display', serif;
  font-style: italic;
  position: absolute;  
  top: 14%;
  left: 15%;
}
.profile-info {
  width: 80%;
  height: 90%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-radius: 30px;
  box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
  background-color: beige;
}
.firstname-con, .lastname-con, .email-con, .contact-con {
  width: 80%;
  height: 50px;
  display: flex;
  flex-direction: row;
  align-items: start;
  justify-content: center;
}
.firstname-con {
  margin-top: 20px;
}
.firstname-con label, .lastname-con label, .email-con label, .contact-con label {
  width: 30%;
  margin: 0;
}
.firstname-con p, .lastname-con p, .email-con p, .contact-con p {
  width: 60%;
  margin: 0;
  margin-top: -3px;
  margin-left: 10px;
  font-family: 'playfair display', serif;
  font-style: italic;
  color: #465048;
}
.edit-button{
  width: 20%;
  height: 30px;
  border: none;
  border-radius: 20px;
  background-color: #465048;
  color: white;
  font-size: .8rem;
  font-family: 'playfair display', serif;
  font-style: italic;
  cursor: pointer;
  margin-bottom: 20px;
  font-weight: 650;
}
.edit-button:hover{
  background-color: #f0f0f0;
  color: #543727;
  border: 2px solid #543727;  
}

h3 {    
  color: #543727;
  margin: 5px;
  font-size: 1.5rem;
  font-family:'playfair display', serif;
  font-weight: 600;
  margin-top: 20px;
  margin-left: 20px;
  font-style: italic;
  width: 90%;
  text-align: center;
} 
form {
    width: 85%;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: start;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
    border-radius: 30px;
    background-color: beige;
  }

.form{
    width: 85%;
    margin-bottom: 0.5rem;
    border-radius: 4px;
    margin-left: 10px;
  }

.form input {
  width: 90%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-left: 25px;
  background-color: rgba(243, 241, 229, 0.61);
}
  
label{
  font-size: .9rem;
  font-family: 'playfair display', serif;
  font-weight: 600;
  color: #465048;
  margin-left: 20px;
}
.edit-cancel{
    width: 100%;
    height: 40px;
    flex-direction: row;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
    margin-top: 10px;
  }
  
  .save, .cancel {
    width: 25%;
    height: 35px;
    border: none;
    border-radius: 20px;
    background-color: #465048;
    color: white;
    font-size: .8rem;
    font-family: 'playfair display', serif;
    font-style: italic;
    cursor: pointer;
    margin-bottom: 20px;
    font-weight: 650;
  }
  .save:hover{
    background-color: #f0f0f0;
    color: #543727;
    border: 2px solid #543727;  
  }

  .cancel:hover{
    background-color: #ff4949dd;
    color: white;
    border: 2px solid #543727;  
  }
  </style>
  
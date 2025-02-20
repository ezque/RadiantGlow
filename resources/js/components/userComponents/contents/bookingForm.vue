<template>
    <div class="booking">
      <button @click="backToServices" class="back-button"></button>
  
      <form @submit.prevent="submitBooking">
        <input type="hidden" v-model="formData.serviceID" />
        <p class="serviceName">Booking for {{ service.serviceName }}</p>
        <p class="Serviceprice">Price: P{{ service.price }}</p>
  
        <div class="form-group">
          <label for="customerName">Customer Name</label>
          <input
            id="customerName"
            type="text"
            v-model="formData.customerName"
            placeholder="Enter your name"
            required
          />
        </div>
  
        <div class="form-group">
          <label for="contactNumber">Contact Number</label>
          <input
            id="contactNumber"
            type="tel"
            v-model="formData.contactNumber"
            placeholder="Enter your contact number"
            required
          />
        </div>
  
        <div class="form-group">
          <label for="appointmentDate">Appointment Date</label>
          <input
            id="appointmentDate"
            type="date"
            v-model="formData.appointmentDate"
            required
          />
        </div>
  
        <div class="form-group">
          <label for="appointmentTime">Appointment Time</label>
          <input
            id="appointmentTime"
            type="time"
            v-model="formData.appointmentTime"
            required
          />
        </div>
        <div class="book-cancel">
          <button type="submit" class="book-button">Book Appointment</button>
          <button @click="backToServices" class="back">Cancel</button>
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  
  // Props
  const props = defineProps({
    service: { type: Object, required: true },
  });
  
  // Emit Event
  const emit = defineEmits(['backToServices', 'bookingSubmitted']);
  const backToServices = () => emit('backToServices');
  
  // Form Data
  const formData = ref({
    serviceID: props.service.id, // Service ID is prefilled
    customerName: '',
    contactNumber: '',
    appointmentDate: '',
    appointmentTime: '',
  });
  
  const submitBooking = async () => {
  try {
    const response = await axios.post('/userAppointments', formData.value);
    alert('Booking successful!');
    console.log(response.data);  // Log the response data
  } catch (error) {
    // Check if the error response exists
    if (error.response) {
      // Handle the case where a response was received
      alert(`Error creating booking: ${error.response.data.message || 'Please try again.'}`);
      console.error(error.response.data);
    } else if (error.request) {
      // Handle the case where the request was made but no response was received
      alert('No response received. Please check your internet connection.');
      console.error(error.request);
    } else {
      // Handle other errors (e.g., issues with setting up the request)
      alert(`Error: ${error.message}`);
      console.error(error.message);
    }
  }
};

  </script>
  
  <style scoped>
  /* Add some basic styling */
  .booking {
    width:80%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  form {
    width: 60%;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
    border-radius: 30px;
    background-color: rgba(192, 178, 131, 0.81);
  }
  
  .form-group {
    margin-bottom: 1rem;
    width: 80%;
    flex-direction: row;
  }
  
  input {
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: rgba(243, 241, 229, 0.61);
  }
  
label{
  font-size: .9rem;
  font-family: 'playfair display', serif;
  font-weight: 600;
  color: #465048;
}

  .back-button{
  width: 55px;
  height: 55px;
  border-radius: 50%;
  cursor: pointer;
  background-image: url('/public/image/back (2).png');
  background-size: cover;
  background-position: center;
  position: relative;
  top: 0%;
  left: -47.8%;
  border: none;
  }

  .book-cancel{
    width: 80%;
    height: 40px;
    flex-direction: row;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-bottom: 10px;
  }
  
  .book-button, .back {
    width: 25%;
    height: 40px;
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
  .book-button:hover{
    background-color: #f0f0f0;
    color: #543727;
    border: 2px solid #543727;  
  }

  .back:hover{
    background-color: #ff4949dd;
    color: white;
    border: 2px solid #543727;  
  }

  .serviceName {
    color: #465048;
    margin: 5px;
    font-size: 1.5rem;
    font-family:'playfair display', serif;
    font-weight: 600;
    margin-top: 20px;
    font-style: italic;
  }
  .Serviceprice {
    color: #543727;
    font-size: 1rem;
    margin: 2px;
    font-family: 'inter', sans-serif;
    font-weight: 800;

  }
  </style>
  
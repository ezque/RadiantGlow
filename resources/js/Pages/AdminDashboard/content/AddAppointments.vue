<template>
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
        <h1>ADD APPOINTMENT</h1>
    </div>
    <div class="appointment-con">
        <form class="add-appointment-card" @submit.prevent="addAppointment">
            <div class="form-row">
                <label class="labels">Full Name: </label>
                <input type="text" v-model="customerName">
            </div>
            <div class="form-row">
                <label class="labels">Contact Number: </label>
                <input type="text" v-model="contactNumber">
            </div>
            <div class="form-row">
                <label class="labels">Appointment Date: </label>
                <input type="date" v-model="appointmentDate">
            </div>
            <div class="form-row">
                <label class="labels">Appointment Time: </label>
                <input type="time" v-model="appointmentTime">
            </div>
            <div class="form-row">
                <label class="labels">Services: </label>
                <select v-if="services.length" v-model="selectedService">
                    <option value="">Select Service</option>
                    <option v-for="service in services" :key="service.id" :value="service.id">
                        {{ service.serviceName }}
                    </option>
                </select>
            </div>
            <div class="add-appointment-bottom-con">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import AdminHeader from '../../../components/adminComponents/AdminHeader.vue';
const props = defineProps({
    services: {
        type: Array,
        required: true
    },
    unreadNotifications: Array,
});

const customerName = ref('');
const contactNumber = ref('');
const appointmentDate = ref('');
const appointmentTime = ref('');
const selectedService = ref('');

const addAppointment = async () => {
    try {
        const response = await axios.post('/appointment', {
            customerName: customerName.value,
            contactNumber: contactNumber.value,
            appointmentDate: appointmentDate.value,
            appointmentTime: appointmentTime.value,
            selectedService: selectedService.value,
        });
        if (response.data.error) {
            alert(response.data.error);
        } else {
            alert(response.data.message);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("An error occurred while adding the appointment.");
    }
};

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.main-label-con{
    width: 100%;
    height: 60px;
    display: flex;
    align-items: center;
}
.main-label-con h1{
    font-size: 2rem;
    font-weight: bold;
    color: #543727;
    margin: 0;
}
.appointment-con{
    margin-top: 40px;
    width: 100%;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    overflow: auto; 
}

.add-appointment-card{
    background-color: #784F38;
    width: 50%;
    height: 100%;
    border-radius: 20px 20px 0 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.form-row {
    display: flex; 
    justify-content: center;
    align-items: center; 
    margin-bottom: 10px; 
    padding: 0px 20px;
    margin-top: 15px;
}
.form-row input,.form-row select{
    width: 30%;
    height: 40px;
    border-radius: 20px;
    border: none;
    color: white;
    padding: 5px;
    background-color: #986D4D;
    flex: 2;
    box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
}

.labels{
    font-weight: bold;
    margin-right: 30px;
    flex: 1; 
    text-align: left;
    color: white;
}

.add-appointment-bottom-con{
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #543727;
}
.add-appointment-bottom-con button{
    width: 30%;
    height: 70%;
    border: none;
    background-color: #A07250;
    color: white;
    border-radius: 20px;
    margin: 10px;
    cursor: pointer;   
    box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
}
.add-appointment-bottom-con button:hover{
    background-color: #784F38;
    font-weight: bold;
    transition: all 0.1s ease;
    border: white 1px solid;
}
</style>
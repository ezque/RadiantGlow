<template>
  <div class="appointment-main">
    <div class="appointmentHeader">
      <button class="back-button" @click="$emit('goBack')"></button>
      <h2 class="Manage">Manage</h2>
      <h2 class="Appointments">Appointments</h2>
    </div>
    <div class="buttons-con">
      <button class="upcoming-button" @click="showAppointments('upcoming')"></button>
      <button class="todays-button" @click="showAppointments('todays')"></button>
      <button class="history-button" @click="showAppointments('history')"></button>
    </div>
    <div class="appointments-con">
      <div v-if="activeTab === 'upcoming'" class="upcoming">
        <table>
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="appointment in upcomingAppointments" :key="appointment.id">
              <td class="appointment-name">{{ appointment.customerName }}</td>
              <td class="appointment-date">{{ appointment.appointmentDate }}</td>
              <td class="appointment-time">{{ appointment.appointmentTime }}</td>
              <td class="appointment-status">{{ appointment.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-if="activeTab === 'todays'" class="todays">
        <table>
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="appointment in todaysAppointments" :key="appointment.id">
              <td class="appointment-name">{{ appointment.customerName }}</td>
              <td class="appointment-date">{{ appointment.appointmentDate }}</td>
              <td class="appointment-time">{{ appointment.appointmentTime }}</td>
              <td class="appointment-status">{{ appointment.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-if="activeTab === 'history'" class="history">
        <table>
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>

            </tr>
          </thead>
          <tbody>
            <tr v-for="appointment in historyAppointments" :key="appointment.id">
              <td class="appointment-name">{{ appointment.customerName }}</td>
              <td class="appointment-date">{{ appointment.appointmentDate }}</td>
              <td class="appointment-time">{{ appointment.appointmentTime }}</td>
              <td class="appointment-status">{{ appointment.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue';

const props = defineProps({
  upcomingAppointments: Array,
  todaysAppointments: Array,
  historyAppointments: Array,
});

const activeTab = ref('upcoming');

const showAppointments = (tab) => {
  activeTab.value = tab;
};
</script>




<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
.appointment-main{
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.appointmentHeader{
  width: 80%;
  height: 15%;
  display: flex;
  flex-direction: row;
  align-items: center;
}
.back-button{
  width: 55px;
  height: 55px;
  border-radius: 50%;
  cursor: pointer;
  background-image: url('/public/image/back (2).png');
  background-size: cover;
  background-position: center;
  border: none;
}
.Manage {
  font-size: 2.8em;
  font-weight: bold;
  color: black;
  margin: 0;
  font-family: 'playfair display', serif;
  font-style: italic;
  position: absolute;  
  top: 13%;
  left: 15%;
}
.Appointments {
  font-size: 2.8em;
  font-weight: bold;
  color: #465048;
  margin: 0;
  font-family: 'playfair display', serif;
  font-style: italic;
  position: absolute;  
  top: 13%;
  left: 26.5%;
}
.buttons-con{
  width: 80%;
  height: 15%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 10%;
}
.buttons-con button{
  width: 14%;
  height: 50px;
  border: none;
  border-radius: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: transparent;
  cursor: pointer;
}
.upcoming-button{
  background-image: url('/public/image/upcoming.png');
  background-size: cover;
  background-position: center;
}
.todays-button{
  background-image: url('/public/image/today.png');
  background-size: cover;
  background-position: center;
}
.history-button{
  background-image: url('/public/image/history.png');
  background-size: cover;
  background-position: center;
}
.appointments-con{
  width: 80%;
  height: 70%;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}
.upcoming{
  width: 90%;
  height: 100%;
}
.todays{
  width: 90%;
  height: 100%;
}
.history{
  width: 90%;
  height: 100%;
}
table{
  width: 100%;
  height: 85%;
  border: 2px solid black;
  border-collapse: collapse;
  background-color: beige;
}
table thead{
  width: 100%;
  height: 15%;
  position: sticky;
  background-color: #543727;
  z-index: 1;
}
table thead tr{
  width: 100%;
  height: 50px;
  display: table;
  table-layout: fixed;
}
table thead tr th{
  font-style: italic;
  font-size: 1.4em;
  font-weight: bold;
  color: white;
  border: 2px solid black;
}
table tbody{
  width: calc(100% + 0px);
  height: calc(100% + 1px); 
  overflow-y: auto; 
  overflow-x: hidden;
  scroll-behavior: smooth;
  scrollbar-width: none;
  display: block;
  border-collapse: collapse;
}
table tbody tr{
  width: 100%;
  height: 40px;
  display: table;
  table-layout: fixed;
  border: 1px solid black;
}
table tbody tr td{
  font-style: 'arial';
  font-size: 1em;
  color: black;
  border: 1px solid black;
}
.appointment-date, .appointment-time, .appointment-status{
  text-align: center;
  font-weight: 450;
}
.appointment-name{
  padding-left: 10px;
}
</style>
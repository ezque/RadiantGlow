<template>
  <div class="dashboardMain">
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
      <h1>DASHBOARD</h1>
    </div>
    <div class="main-content-con">
      <label for="">Weekly Appoinments</label>
        <FirstBargraph 
          :appointmentsByDay="appointmentsByDay"
        />
      <label for="">Monthly Appointments</label>
      <FirstBargraph 
        :appointmentsByDay="appointmentsByMonth"
      />
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import AdminHeader from '../../../components/adminComponents/AdminHeader.vue';
import FirstBargraph from '../../../components/adminComponents/firstBargraph.vue';

const props = defineProps({
  customerCount: Number,
  appointmentCount: Number,
  unreadNotifications: Array,
  appointmentsByDay: Array,
  appointmentsByMonth: Array,
});


</script>








<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
.dashboardMain{
  width: 100%;
  height: 100%;
  background-image: url('/image/main-background.png');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  display: flex;
  flex-direction: column;
}

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
.main-content-con{
  width: 95%;
  height: 500px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border: 1px solid black;
  overflow: auto;
  padding: 20px;
}
.main-content-con {
  width: 95%;
  height: auto; /* Adjusted to auto for better content overflow handling */
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  border: 1px solid #ccc; /* Light border for separation */
  overflow: auto;
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
  border-radius: 12px;
}

/* Title styling for graphs */
.main-content-con label {
  font-size: 1.8rem;
  font-weight: bold;
  margin-bottom: 10px;
  color: #543727;
}

/* Styling for graph containers */
.bargraph-container {
  width: 100%;
  max-width: 900px;
  margin: 20px 0;
  padding: 1rem;
  background: #1e293b; /* Dark background for graph */
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Ensuring graphs scale well on smaller screens */
@media (max-width: 768px) {
  .bargraph-container {
    width: 90%;
    padding: 1rem;
  }
}

/* Styling for graph labels */
.bargraph-container label {
  font-size: 1.6rem;
  color: #ffffff;
  margin-bottom: 8px;
  text-align: center;
}

/* Additional customization for the graph */
.chart-container {
  width: 100%;
  max-width: 800px;
  margin: 2rem auto;
  padding: 1.5rem;
  background: #1e293b; /* Dark theme background */
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
}

.chartjs-legend {
  font-size: 14px;
  color: #ffffff;
}

.chartjs-tooltip {
  background-color: rgba(0, 0, 0, 0.7);
  color: #fff;
}
</style>
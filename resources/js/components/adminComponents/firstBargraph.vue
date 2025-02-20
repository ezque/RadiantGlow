<template>
    <div class="bargraph-container">
      <Bar v-if="chartData" :data="chartData" :options="chartOptions" />
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  import { Bar } from 'vue-chartjs';
  import {
    Chart as ChartJS,
    BarElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Legend,
  } from 'chart.js';
  
  // Register chart components
  ChartJS.register(BarElement, CategoryScale, LinearScale, Tooltip, Legend);
  
  // Props from parent
  const props = defineProps({
    appointmentsByDay: {
      type: Array,
      required: true,
    },
  });
  
  // Reactive chartData computed based on the received data
  const chartData = computed(() => {
    const isWeekly = props.appointmentsByDay.length === 7; // If 7, assume it's weekly data
    const labels = isWeekly
      ? ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
      : [
          'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
          'September', 'October', 'November', 'December',
        ];
  
    return {
      labels,
      datasets: [
        {
          label: isWeekly ? 'Weekly Appointments' : 'Monthly Appointments',
          backgroundColor: '#42A5F5',
          data: props.appointmentsByDay, // Data passed from parent
        },
      ],
    };
  });
  
  const chartOptions = {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
    },
  };
  </script>
  
  <style scoped>
  /* Container for the graph */
  .bargraph-container {
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem;
    background: #1e293b; /* Dark theme background */
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  /* Styling for responsiveness */
  @media (max-width: 768px) {
    .bargraph-container {
      width: 95%;
      padding: 1rem;
    }
  }
  
  /* Optionally, style the legend and tooltips in chart.js */
  .chartjs-legend {
    font-size: 14px;
    color: #ffffff;
  }
  
  .chartjs-tooltip {
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
  }
  </style>
  
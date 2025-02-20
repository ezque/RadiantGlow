<template>
    <div class="manage-appointments-container">
        <AdminHeader :notifications="unreadNotifications" />
        <div class="main-label-con">
            <h1>MANAGE APPOINTMENTS</h1>
        </div>
        <div class="main-manage-appointment-con">
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Service</th>
                        <th>Appointment Schedule</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(appointment, index) in appointments" :key="appointment.id">
                        <td class="main-manage1">{{ appointment.customerName }}</td>
                        <td class="main-manage1">{{ appointment.contactNumber }}</td>
                        <td class="main-manage1">{{ appointment.service.serviceName }}</td>
                        <td class="main-manage1">{{ appointment.appointmentDate }} {{ appointment.appointmentTime }}</td>
                        <td class="main-manage1">{{ appointment.status }}</td>
                        <td class="main-manage1 button-container">
                            <template v-if="appointment.status === 'pending'">
                                <button class="btn confirm" @click="updateAppointmentStatus(appointment.id, 'confirmed', index)">Confirm</button>
                                <button class="btn reject" @click="updateAppointmentStatus(appointment.id, 'rejected', index)">Reject</button>
                            </template>
                            <template v-else-if="appointment.status === 'confirmed'">
                                <button class="btn cancel" @click="updateAppointmentStatus(appointment.id, 'cancelled', index)">Cancel</button>
                                <button class="btn done" @click="updateAppointmentStatus(appointment.id, 'done', index)">Done</button>
                            </template>
                            <template v-else-if="appointment.status === 'done' || appointment.status === 'cancelled' || appointment.status === 'rejected'">
                                <button class="btn delete" @click="deleteAppointment(appointment.id, index)">Delete</button>
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import AdminHeader from '../../../components/adminComponents/AdminHeader.vue';

const props = defineProps({
  appointments: { type: Array, required: true },
  unreadNotifications: Array,
});

const updateAppointmentStatus = async (appointmentId, status, index) => {
    try {
        const response = await axios.put(`/appointments/${appointmentId}`, { status });
        if (response.status === 200) {
            props.appointments[index].status = status;
            alert(`Appointment marked as ${status}.`);
        }
    } catch (error) {
        console.error(`Error updating appointment status: ${error.response?.data || error.message}`);
        alert("Failed to update the appointment status. Please try again.");
    }
};

const deleteAppointment = async (appointmentId, index) => {
    try {
        if (!confirm("Are you sure you want to delete this appointment?")) {
            return;
        }

        const response = await axios.delete(`/appointments/${appointmentId}`);
        if (response.status === 200) {
            props.appointments.splice(index, 1);
            alert("Appointment deleted successfully.");
        }
    } catch (error) {
        console.error(`Error deleting appointment: ${error.response?.data || error.message}`);
        alert("Failed to delete the appointment. Please try again.");
    }
};
</script>

<style scoped>
/* General Styles */
.main-label-con {
    width: 100%;
    height: 60px;
    display: flex;
    align-items: center;
}

.main-label-con h1 {
    font-size: 2rem;
    font-weight: bold;
    color: #543727;
    margin: 0;
}

.main-manage-appointment-con {
    margin-top: 40px;
    width: 100%;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
    overflow: auto; 
    padding-bottom: 30px;
}

.main-manage-appointment-con table {
    width: 90%;
    max-height: 500px; 
    border-collapse: collapse; 
    margin: 0 auto; 
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); 
}

.main-manage-appointment-con th, .main-manage-appointment-con td {
    padding: 10px;
    text-align: center;
}

.main-manage-appointment-con th {
    background-color: #784F38; 
    color: white; 
}

.main-manage-appointment-con tbody tr:nth-child(even) {
    background-color: #f2f2f2; 
}

.main-manage-appointment-con tbody tr:nth-child(odd) {
    background-color: white;
}

.main-manage-appointment-con tbody tr:hover {
    background-color: #ddd; 
}

/* Action Button Styles */
td.button-container {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
}

.btn {
    width: 100px;
    height: 35px;
    border: none;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn.confirm {
    background-color: #4CAF50; 
    opacity: 60%;
    box-shadow: 4px 4px 6px black;
}

.btn.reject {
    background-color: #f44336;
    opacity: 60%;
    box-shadow: 4px 4px 6px black;
}

.btn.cancel {
    background-color: #FFA500;
    opacity: 60%;
    box-shadow: 4px 4px 6px black;
}

.btn.done {
    background-color: #2196F3; /* Blue */
    opacity: 60%;
    box-shadow: 4px 4px 6px black;
}

.btn.delete {
    background-color: #9E9E9E; /* Gray */
    opacity: 60%;
    box-shadow: 4px 4px 6px black;
}

/* Hover Effects */
.btn:hover {
    background-color: white;
    color: black;
    border: 2px solid currentColor;
}

/* Responsive Adjustments */
@media (max-width: 600px) {
    table {
        width: 100%; 
    }

    td.button-container {
        flex-wrap: wrap;
    }

    .btn {
        width: 80px;
        font-size: 0.8em;
    }
}
</style>

<template>
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
        <h1>MANAGE CUSTOMERS</h1>
    </div>
    <div class="main-customer-main">
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(customer, index) in customers" :key="customer.id">
                    <td class="customer-3">{{ customer.firstName }} {{ customer.lastName }}</td>
                    <td class="customer-2">{{ customer.email }}</td>
                    <td class="customer-1" :class="`status ${customer.status.toLowerCase()}`">{{ customer.status }}</td>
                    <td class="customer-3">{{ new Date(customer.created_at).toLocaleDateString() }}</td>
                    <td class="customer-3">
                        <button class="customer-button-2"
                            @click="toggleCustomerStatus(customer.id, index)">
                            {{ customer.status === 'active' ? 'Block' : 'Unblock' }}
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import axios from 'axios';
import AdminHeader from '../../../components/adminComponents/AdminHeader.vue';

// Props from the parent component
const props = defineProps({
    customers: {
        type: Array,
        required: true
    },
    unreadNotifications: Array,
});

// Method to toggle the customer's status between "active" and "blocked"
const toggleCustomerStatus = async (customerId, index) => {
    try {
        // Determine the new status
        const newStatus = props.customers[index].status === 'active' ? 'blocked' : 'active';

        // Send a request to update the customer's status in the backend
        const response = await axios.post(`/customers/${customerId}/block`, {
            status: newStatus
        });

        if (response.status === 200) {
            // Update the customer's status locally
            props.customers[index].status = newStatus;
            alert(`Customer with ID ${customerId} is now ${newStatus}.`);
        }
    } catch (error) {
        console.error("Error toggling customer status:", error.response?.data || error.message);
        alert("Failed to update the customer status. Please try again.");
    }
};
</script>
    


<style scoped>
.notif-con{
    display: flex;
    width: 100%;
    height: 50px;
    align-items: center;
    justify-content: end;
}
.notif-con img{
    width: 30px;
    height: auto;
    margin-right: 10px;
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
.main-customer-main{
    margin-top: 40px;
    width: 100%;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
    overflow: auto; 
}

table {
    margin-top: 30px;
    width: 90%; 
    height: auto;
    max-height: 500px; 
    border-collapse: collapse; 
    margin: 0 auto; 
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); 
}

td {
    border: 1px solid #986D4D; 
    padding: 10px; 
    text-align: left;
}

.customer-1 {
    text-align: center;
    color: green;
    font-weight: bold;
    font-size: .9em;
}

.customer-2 {
    text-align: center;
    font-style: italic;
    font-size: .9em;
}

.customer-3 {
    text-align: center;
    font-size: .9em;
}


.customer-button-1 {
    width: 60%;
    height: 30px;
    border: none;
    background-color: #FF2525;
    color: white;
    border-radius: 20px;
    font-weight: bold;
    display: inline-block;
}

.customer-button-2 {
    width: 60%;
    height: 30px;
    border: none;
    background-color: #ED0F0F;
    color: white;
    border-radius: 20px;
    font-weight: bold;
    display: inline-block;
    padding: 5px;
}

.customer-button-2:hover {
    border: red 1px solid;
    background-color: white;
    color: red;
}

th {
    background-color: #543727; 
    color: white; 
    padding: 10px; 
    text-align: center;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2; 
}

tbody tr:nth-child(odd) {
    background-color: white;
}

tbody tr:hover {
    background-color: #ddd; 
}

@media (max-width: 600px) {
    table {
        width: 100%; 
    }
}

</style>
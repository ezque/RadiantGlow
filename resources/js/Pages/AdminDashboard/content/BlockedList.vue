<template>
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
        <h1>BLOCKED CUSTOMERS</h1>
    </div>
    <div class="main-blocked-customer-main">
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
                    <td class="blocked-3">{{ customer.firstName }} {{ customer.lastName }}</td>
                    <td class="blocked-2">{{ customer.email }}</td>
                    <td class="blocked-1">Blocked</td>
                    <td class="blocked-3">{{ new Date(customer.created_at).toLocaleDateString() }}</td>
                    <td class="blocked-3">
                        <button 
                            class="blocked-3" 
                            @click="unblockCustomer(customer.id, index)">
                            Unblock
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

const props = defineProps({
    customers: {
        type: Array,
        required: true
    },
    unreadNotifications: Array,
});

const unblockCustomer = async (customerId, index) => {
    try {
        // Send a request to update the customer's status in the backend
        const response = await axios.post(`/customers/${customerId}/unblock`, {
            status: 'active'
        });

        if (response.status === 200) {
            // Update the customer's status locally
            props.customers[index].status = 'active';
            alert(`Customer with ID ${customerId} is now active.`);
        }
    } catch (error) {
        console.error("Error unblocking customer:", error.response?.data || error.message);
        alert("Failed to unblock the customer. Please try again.");
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
.main-blocked-customer-main{
    margin-top: 40px;
    width: 100%;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
    overflow: auto; 
    padding-bottom: 30px;
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

.blocked-1 {
    text-align: center;
    color: red;
    font-weight: bold;
    font-size: .9em;
}

.blocked-2 {
    text-align: center;
    font-size: .9em;
    font-style: italic;
    font-size: .9em;
}

.blocked-3 {
    text-align: center;
    font-size: .9em;
}

.blocked-3 button {
    width: 80%;
    height: 30px;
    border: none;
    background-color: #0FA3ED;
    color: white;
    border-radius: 20px;
    font-weight: bold;
}

.blocked-3 button:hover {
    border: #0FA3ED 1px solid;
    background-color: white;
    color: #0FA3ED;
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
    background-color: white; 
}

@media (max-width: 600px) {
    table {
        width: 100%; 
    }
}
</style>
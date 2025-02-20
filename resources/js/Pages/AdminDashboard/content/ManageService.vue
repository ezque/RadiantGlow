<template>
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
        <h1>MANAGE SERVICE</h1>
    </div>
    <div class="main-manage-service-con">
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(service, index) in services" :key="service.id">
                    <td class="bold1">{{ service.categoryID }}</td>
                    <td class="bold2">
                        <span v-if="editIndex !== index">{{ service.serviceName }}</span>
                        <input v-else v-model="service.serviceName" />
                    </td>
                    <td class="bold3">
                        <span v-if="editIndex !== index">{{ service.price }}</span>
                        <input v-else v-model="service.price" type="number" />
                    </td>
                    <td class="bold4">
                        <button v-if="editIndex !== index" @click="editIndex = index">Edit</button>
                        <button v-else @click="saveService(index)">Save</button>
                        <button @click="deleteService(index)">Delete</button>
                        <button @click="toggleStatus(index)">Toggle Status</button>
                    </td>
                    <td>
                        <span :class="{'active-status': service.status === 'active', 'inactive-status': service.status === 'inactive'}">
                            {{ service.status }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>  
</template>

<script setup>
import { ref } from 'vue';
import AdminHeader from '../../../components/adminComponents/AdminHeader.vue';

const props = defineProps({
    services: {
        type: Array,
        required: true
    },
    categories:{
        type: Array,
        required: true
    },
    unreadNotifications: Array,
    
});

const editIndex = ref(null);

function toggleStatus(index) {
    const service = props.services[index];
    service.status = service.status === 'active' ? 'inactive' : 'active';
}

function deleteService(index) {
    if (confirm('Are you sure you want to delete this service?')) {
        props.services.splice(index, 1);
    }
}

function saveService(index) {
    editIndex.value = null;
    console.log('Service updated:', props.services[index].serviceName);
}
</script>

<style scoped>
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

.main-manage-service-con {
    font-size: 2em;
    margin-left: 10px;
    padding-bottom: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #F7F0E1;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table th,
table td {
    padding: 10px;
    text-align: center;
    font-size: 1.1rem;
    color: #543727;
}

table th {
    background-color: #543727;
    color: white;
    font-weight: bold;
}

.bold1 {
    font-weight: bold;
}

.bold3 {
    font-style: italic;
}

.bold4 {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

button {
    background-color: #A07250;
    color: white;
    padding: 8px 12px;
    font-size: .8rem;
    border-radius: 8px;
    cursor: pointer;
    border: none;
    transition: background-color 0.3s;
    font-weight: bold;
}

button:hover {
    background-color: #543727;
}

button:active {
    transform: scale(0.98);
}

button:focus {
    outline: none;
}

.active-status {
    color: green;
    font-weight: bold;
}

.inactive-status {
    color: red;
    font-weight: bold;
}

input {
    width: 80%;
    padding: 6px;
    font-size: 1rem;
    margin-top: 5px;
    border: 1px solid #C5A88A;
    border-radius: 8px;
}

input:focus {
    outline: none;
    border-color: #A07250;
}
</style>

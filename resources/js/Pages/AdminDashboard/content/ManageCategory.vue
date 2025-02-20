<template>
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
        <h1>MANAGE CATEGORY</h1>
    </div>
    <div class="main-manage-service-con">
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in categories" :key="category.id">
                    <td>
                        <!-- Editable Category Name -->
                        <div v-if="editIndex === index">
                            <input 
                                v-model="category.categoryName" 
                                @blur="editIndex = null" 
                                @keyup.enter="saveCategory(index)" 
                                class="edit-input"
                            />
                        </div>
                        <div v-else>
                            {{ category.categoryName }}
                            <button @click="editIndex = index" class="action-button edit-button">
                                <img src="/public/image/editing.png" alt="edit">
                            </button>
                        </div>
                    </td>
                    <td>
                        <button @click="toggleStatus(index)" 
                                class="action-button toggle-button"
                                :class="{'active-status': category.status === 'active', 'inactive-status': category.status === 'inactive'}">
                            {{ category.status === 'active' ? 'Set Inactive' : 'Set Active' }}
                        </button>
                        <button @click="deleteCategory(index)" class="action-button delete-button">Delete</button>
                    </td>
                    <td :class="{ 'active-status': category.status === 'active', 'inactive-status': category.status === 'inactive' }">
                        {{ category.status }}
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
    categories: {
        type: Array,
        required: true
    },
    unreadNotifications: Array,
});

const editIndex = ref(null);

async function toggleStatus(index) {
    const categoryId = props.categories[index].id;

    try {
        const response = await axios.patch(`/categories/${categoryId}/toggle-status`);
        props.categories[index].status = response.data.status;

        alert(response.data.message);
    } catch (error) {
        console.error('Error toggling category status:', error.response?.data || error.message);
        alert('Failed to toggle the category status.');
    }
}

async function deleteCategory(index) {
    const categoryId = props.categories[index].id;

    if (confirm('Are you sure you want to delete this category?')) {
        try {
            const response = await axios.delete(`/categories/${categoryId}`);

            alert(response.data.message);

            // Remove the category from the list
            props.categories.splice(index, 1);
        } catch (error) {
            console.error('Error deleting category:', error.response?.data || error.message);
            alert('Failed to delete the category.');
        }
    }
}

async function saveCategory(index) {
    const categoryId = props.categories[index].id;
    const updatedName = props.categories[index].categoryName;

    try {
        const response = await axios.put(`/categories/${categoryId}/update-name`, {
            categoryName: updatedName,
        });

        alert(response.data.message);
        editIndex.value = null;
    } catch (error) {
        console.error('Error updating category name:', error.response?.data || error.message);
        alert('Failed to update the category name.');
    }
}
</script>

<style scoped>


/* Page heading */
.main-label-con {
    padding: 10px 20px;
    border-bottom: 1px solid #e0e0e0;
    margin-bottom: 20px;
}

.main-label-con h1 {
    font-size: 2rem;
    font-weight: bold;
    color: #543727;
    margin: 0;
}

.main-manage-service-con {
    margin: 20px;
    padding: 20px;
    border-radius: 12px;
    overflow-x: auto;

}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 1em;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

th, td {
    padding: 14px 20px;
    border-bottom: 1px solid #e6e6e6;
}

th {
    background-color: #543727;
    color: #f5f5f5;
    text-align: center;
    font-weight: 600;
}

td {
    background-color: #fefefe;
    text-align: center;
    border: 1px solid #986D4D;
}

tbody tr:hover {
    background-color: #f1f5f9;
    transition: background-color 0.3s ease;
}

/* Action buttons */
.action-button {
    margin-right: 6px;
    border: none;
    border-radius: 6px;
    font-size: 0.9em;
    cursor: pointer;
    color: #fff;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-weight: 600;
}

.edit-button {
    width: 30px;
    height: 30px;
    background-color: transparent;
}
.edit-button img {
    width: 100%;
    height: auto;
}
.edit-button:hover {
    filter: invert(100%);
    background-color: #543727;
    transform: scale(1.1);
}

.delete-button {
    background: linear-gradient(135deg, #e63946, #c02a36);
    padding: 6px 14px;
    border-radius: 6px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.delete-button:hover {
    background: linear-gradient(135deg, #c02a36, #e63946);
    transform: scale(1.1);
}

.toggle-button {
    background-color: #a8d44f;
    padding: 6px 14px;
    border-radius: 6px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.toggle-button:hover {
    background-color: white;
    border: #88b73c 1px solid;
    transform: scale(1.05);
}

.active-status {
    color: #27ae60;
    font-weight: bold;
    text-transform: uppercase;
    font-family: Arial, Helvetica, sans-serif;
}

.inactive-status {
    color: #e63946;
    font-weight: bold;
    text-transform: uppercase;
    font-family: Arial, Helvetica, sans-serif;
}

/* Edit input styling */
.edit-input {
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 85%;
    font-size: 1em;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .main-label-con h1 {
        font-size: 1.6em;
    }
    table, th, td {
        font-size: 0.9em;
    }
}
</style>

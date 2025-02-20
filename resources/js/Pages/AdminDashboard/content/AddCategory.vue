<template>
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
        <h1>ADD CATEGORY</h1>
    </div>
    <div class="main-add-service-con">
        <form class="add-service-card" @submit.prevent="addCategory">
            <div class="input-group">
                <input class="formInput" type="text" placeholder="Category Name" v-model="categoryName">
                <textarea placeholder="Category Description" v-model="categoryDescription"></textarea>

                <input class="inputFile" type="file" name="image" id="image" accept="image/*" @change="handleFileChange" required>
            </div>
            <div class="bottom-button-con">
                <button type="submit">Add Category</button>
            </div>
        </form>
    </div>

    <!-- Display errors if there are any -->
    <div v-if="errors" class="error-messages">
        <ul>
            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
    </div>

    <!-- Display success message -->
    <div v-if="message" class="success-message">
        <p>{{ message }}</p>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import AdminHeader from '../../../components/adminComponents/AdminHeader.vue';

const props = defineProps({
    unreadNotifications: Array,
});

const categoryName = ref('');
const categoryDescription = ref('');
const imageFile = ref(null);
const errors = ref([]);
const message = ref('');

const handleFileChange = (event) => {
    imageFile.value = event.target.files[0];
};

const addCategory = async () => {
    try {
        const formData = new FormData();
        formData.append('categoryName', categoryName.value);
        formData.append('categoryDescription', categoryDescription.value);
        formData.append('image', imageFile.value);

        const response = await axios.post('/categories', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        // On success, show the success message
        message.value = response.data.message;

        // Reset form fields
        categoryName.value = '';
        categoryDescription.value = '';
        imageFile.value = null;
        document.getElementById('image').value = ''; // Reset file input

        // Clear errors if any
        errors.value = [];

    } catch (error) {
        // Handle validation errors or other server-side errors
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors; // Display validation errors
        } else {
            console.error("Error:", error.response?.data || error.message);
            alert('Something went wrong');
        }
    }
};
</script>



<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
.notif-con {
    display: flex;
    width: 100%;
    height: 50px;
    align-items: center;
    justify-content: end;
}
.notif-con img {
    width: 30px;
    height: auto;
    margin-right: 10px;
}
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
.main-add-service-con {
    width: 100%;
    height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.add-service-card {
    background-color: #784F38;
    width: 400px;
    height: 400px;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
}
.input-group {
    width: 100%;
    height: 80%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.input-group input, .input-group textarea {
    width: 80%;
    height: 40px;
    border-radius: 20px;
    border: none;
    color: white;
    padding: 10px;
    margin: 10px 0;
    background-color: #986D4D;
    font-size: .8em;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
}

.custom-file-label {
    display: flex;
    width: 80%;
    padding: 10px;
    text-align: center;
    background-color: #A07250;
    color: white;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-file-label:hover {
    background-color: #784F38;
}

.input-group textarea {
    height: 100px;
    resize: none;
}

.input-group input::placeholder, .input-group textarea::placeholder {
    color: rgba(255, 255, 255, 0.7); 
    font-style: italic;
}

.bottom-button-con {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #543727;
}
.bottom-button-con button {
    width: 40%;
    height: 70%;
    border: none;
    background-color: #A07250;
    color: white;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
}

.bottom-button-con button:hover {
    background-color: #784F38;
    font-weight: bold;
    transition: all 0.1s ease;
    border: white 1px solid;    
}
</style>

<template>
    <AdminHeader 
      :notifications="unreadNotifications"
    />
    <div class="main-label-con">
        <h1>ADD SERVICE</h1>
    </div>
    <div class="main-add-service-con">
        <form class="add-service-card" @submit.prevent="addService">
            <input type="text" placeholder="Service Name" v-model="serviceName" required>

            <div class="form-select">
                <select v-if="categories.length" v-model="selectedCategory" required >
                    <option disabled selected>Select a category</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.categoryName }}
                    </option>
                </select>
            </div>

            <input type="number" placeholder="Price" v-model="price" required>
            <div class="file">
                <input type="file" accept="image/*" @change="handleFileChange" required>
            </div>
            <div class="bottom-button-con">
                <button type="submit">Add Service</button>
            </div>
        </form>
        
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

// Form data
const serviceName = ref('');
const selectedCategory = ref('');
const price = ref('');
const imageFile = ref(null);

// Handle file selection
const handleFileChange = (event) => {
    imageFile.value = event.target.files[0];
};

// Form submission function
const addService = async () => {
    try {
        const formData = new FormData();
        formData.append('serviceName', serviceName.value);
        formData.append('categoryID', selectedCategory.value);
        formData.append('price', price.value);
        formData.append('image', imageFile.value);

        const response = await axios.post('/services', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        alert(response.data.message);

        // Reset fields after submission
        serviceName.value = '';
        selectedCategory.value = '';
        price.value = '';
        imageFile.value = null;
    } catch (error) {
        console.error("Error:", error.response?.data || error.message);
        alert('Something went wrong');
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
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
.main-add-service-con{
    width: 100%;
    height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.add-service-card{
    background-color: #784F38;
    width: 400px;
    height: 360px;
    border-radius: 20px 20px 0 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    gap:20px;
}
.add-service-card input{
    width: 80%;
    height: 40px;
    border-radius: 20px;
    border: none;
    color: white;
    padding: 5px;
    background-color: #986D4D;
    box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
    font-family: 'Poppins', sans-serif;
    margin-top: 10px;
}
.form-select{
    width: 80%;
    height: 40px;
    border-radius: 20px;
    border: none;
    color: white;
    padding: 5px;
    background-color: #986D4D;
    box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
    align-items: start;
    justify-content: start;
}
.form-select select{
    width: 100%;
    height: 100%;
    border: none;
    color: white;
    background-color: #986D4D;
    font-size: .8em;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    border-radius: 20px;
}
.file {
    width: 80%;
    height: auto;
    border: none;
    color: white;
    background-color: none;
    font-size: 1em;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    border-radius: 20px;
}
.file input {
    width: 95%;
    height: auto;
    border: none;
    color: white;
    background-color: none;
    font-size: .8em;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    border-radius: 15px;
    justify-content: center;
    justify-items: center;
    padding: 10px;
}
.add-service-card input::placeholder {
    color: white; 
}
.bottom-button-con{
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #543727;

}
.bottom-button-con button{
    width: 40%;
    height: 70%;
    border: none;
    background-color: #A07250;
    color: white;
    border-radius: 20px;
    margin-bottom: 0;
}
.bottom-button-con button:hover{
    background-color: #784F38;
    font-weight: bold;
    transition: all 0.1s ease;
    border: white 1px solid;
}
</style>
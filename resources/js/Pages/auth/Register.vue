<template>
    <body>
        <div class="register-body">
            <div class="left-side"></div>
            <div class="right-side">
                <div class="back-logo">
                    <a>
                        <img @click.prevent="goBack" src="/public/image/back.png" alt="back">
                    </a>
                </div>
                <div class="register-con">
                    <div class="logo-con">
                        <img src="/public/image/radiant-color.png" alt="radiant">
                    </div>
                    <form class="register-input" @submit.prevent="register">
                        <input type="email" placeholder="Email" name="email" v-model="form.email" required>
                        <input type="text" placeholder="First Name" name="firstName" v-model="form.firstName" required>
                        <input type="text" placeholder="Last Name" name="lastName" v-model="form.lastName" required>
                        <input type="number" placeholder="Contact Number" name="contactNumber" v-model="form.contactNumber" required>
                        <input type="password" placeholder="Password" name="password" v-model="form.password" required>
                        <input type="password" placeholder="Re-enter Password" name="password_confirmation" v-model="form.password_confirmation" required>
                        <p>Already have an account? <Link href="/login">Login</Link></p>
                        <button type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const form = reactive({
    email: '',
    firstName: '',
    lastName: '',
    contactNumber: '',
    password: '',
    password_confirmation: ''
});

const register = () => {
    Inertia.post('/register', form, {
        onSuccess: () => {
            Inertia.visit('/login');
        },
        onError: (errors) => {
            const errorMessages = Object.values(errors).flat().join(', ');
            alert('Registration failed: ' + errorMessages);
        }
    });
};

const goBack = () => {
    Inertia.visit('/');
};

</script>

<style scoped>
.register-body {
    height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: row;
    overflow: hidden;
}
.left-side {
    width: 60%;
    height: 100%;
    background-image: url('/image/login-pic.png');
    background-size: cover;
    background-position: center;
}
.right-side {
    width: 40%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
}
.back-logo {
    width: 100px;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: end;
    position: absolute;
    left: 10px;
    top: 20px;
    z-index: 10;
    pointer-events: auto;
}
.back-logo a img {
    width: 40%;
    height: auto;
    cursor: pointer;
}
.register-con {
    width: 70%;
    height: 60%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-right: 50px;
}
.logo-con {
    width: 100%;
    height: 20%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.logo-con img {
    width: 40%;
    height: auto;
}
.register-input {
    width: 100%;
    height: 80%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.register-input input {
    width: 80%;
    height: 10%;
    margin: 5px;
    border-radius: 10px;
    padding: 5px;
    border: 1px solid black;
}
.register-input button {
    width: 40%;
    height: 40px;
    border-radius: 30px;
    background-color: #543727;
    color: white;
    border: none;
    font-size: 1em;
    font-weight: 600;
    cursor: pointer;
}
</style>

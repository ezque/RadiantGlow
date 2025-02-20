<template>
    <div class="login-body">
        <div class="left-side"></div>
        <div class="right-side">
            <div class="back-logo">
                <a @click.prevent="goBack">
                    <img src="/public/image/back.png" alt="back">
                </a>
            </div>
            <div class="login-con">
                <div class="logo-con">
                    <img src="/public/image/radiant-color.png" alt="radiant">
                </div>
                <form class="login-input" @submit.prevent="login">
                    <input type="text" placeholder="Email" name="email" v-model="form.email" required>
                    <input type="password" placeholder="Password" name="password" v-model="form.password" required>
                    <p>Don't have an account? <Link href="/register">Register</Link></p>
                    <button type="submit">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const form = reactive({
    email: '',
    password: ''
});

const login = () => {
    Inertia.post('/login', form, {
        onSuccess: (page) => {
            const redirectPath = page.props.redirect;
            if (redirectPath) {
                Inertia.visit(redirectPath);
            }
        },
        onError: (errors) => {
            alert('Login failed: ' + (errors.email || 'Unknown error occurred'));
        }
    });
};


const goBack = () => {
    Inertia.visit('/');
};
</script>


<style scoped>


.login-body{
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
.login-con{
    width: 60%;
    height: 60%;  
    display: flex;
    flex-direction: column;
    align-items: center;    
    justify-content: center;
    gap: 20px;
}
.logo-con{
    width: 100%;
    height: 20%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.logo-con img{
    width: 50%;
    height: auto;
}
.login-input{
    width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.login-input input{
    width: 80%;
    height: 20px;
    border-radius: 10px;
    padding: 10px;
}
.login-input p{
    width: 100%;
    height: auto;
    color: #818181;
    font-size: 1em;
    text-align: center;
    padding: 10px;
}
.login-input button{
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
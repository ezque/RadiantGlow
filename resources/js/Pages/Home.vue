<template>
    <div class="home-body">
        <Header />
        <div class="home-main">
            <div class="radiant">
                <img src="/public/image/RADIANT-GLOW.png" alt="radiant">
                <Link href="/login">
                    <button>BOOK NOW</button>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Header from '../Pages/Header.vue';
</script>

<style scoped>
.home-body {
    background-image: url('/image/background.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    overflow: hidden;
    margin: 0;
}
.home-main {
    margin-top: 100px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: end;
}
.radiant {
    width: 20%;
    height: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-bottom: 200px;
    margin-right: 50px;
}
.radiant img {
    width: 80%;
    height: auto;
}
.radiant button {
    width: 250px;
    height: 30px;
    margin-top: 40px;
    border-radius: 20px;
    border: none;
    cursor: pointer;
}
</style>

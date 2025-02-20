<template>
    <div class="services-body">
        <Header />
        <div class="services-main">
            <div class="service-con">
                <div class="service-header">
                    <h2>SERVICES</h2>
                </div>
                <div class="service-content">
                    <div class="content">
                        <br>
                        <p>Radiant Glow Salon offers a variety of luxury beauty services designed to enhance your natural radiance. 
                            Our expert stylists and therapists provide personalized haircuts, creative coloring, rejuvenating skin treatments, and precision nail care, all in a serene, welcoming environment. 
                            Whether you're in need of a quick beauty touch-up or a complete day of relaxation, Radiant Glow promises a tailored experience, using high-quality products and modern techniques to leave you feeling revitalized and confident. 
                            Indulge in a transformative self-care journey with us, where every detail is crafted to make you shine.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Header from '../Pages/Header.vue';
</script>

<style scoped>
.services-body{
    background-image: url('/image/background.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    overflow: hidden;
    margin: 0;
}
.services-main{
    margin-top: 100px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.service-con{
    width: 60%;
    height: 70%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #672F2F;
    opacity: 87%;
    border-radius: 20px;
    margin-top: -50px;
}
.service-header{
    width: 100%;
    height: 10%;
    display: flex;
    margin-top: 30px;
}
.service-header h2{
    font-size: 1.9em;
    padding-left: 40px;
    padding-top: 0px;
    color: white;
}
.service-content{
    width: 100%;
    height: 80%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 15px;
}
.content{
    width: 90%;
    height: 100%;
    display: flex;
    font-size: 1.2em;   
    text-justify: distribute;
    color: white;
    flex-direction: column;
}
content p{
    font-size: 1.2em;  
    text-align: justify;
    color: white;
    flex-direction: row;
}
</style>
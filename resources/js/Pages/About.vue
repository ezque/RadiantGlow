<template>
    <div class="about-body">
        <Header />
        <div class="about-main">
            <div class="about-con">
                <div class="about-header">
                    <h2>ABOUT US</h2>
                </div>
                <div class="about-content">
                    <div class="content">
                        <br>
                        <p>Radiant Glow Salon is your ultimate destination for luxury beauty and self-care. Our salon is dedicated to providing an exceptional experience, offering a wide range of services including hair styling, coloring, skin treatments, nail care, and relaxation therapies. At Radiant Glow, we combine the latest beauty techniques with high-quality products to ensure our clients leave looking and feeling their best.</p>
                        <br>
                        <p>With a team of experienced and passionate professionals, we customize each service to meet your individual needs, ensuring a radiant glow from the inside out. Whether you're looking for a fresh haircut, a rejuvenating facial, or a full day of pampering, Radiant Glow Salon is here to deliver a transformative experience in a warm, relaxing atmosphere.</p>
                        <br>   
                        <p>Visit us and shine with confidence!</p>
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
.about-body{
    background-image: url('/image/background.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    overflow: hidden;
    margin: 0;
}
.about-main{
    margin-top: 100px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.about-con{
    width: 60%;
    height: 70%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #672F2F;
    opacity: 87%;
    border-radius: 20px;
    margin-bottom: 100px;
}
.about-header{
    width: 100%;
    height: 10%;
    display: flex;
    margin-top: 30px;
}
.about-header h2{
    font-size: 1.9em;
    padding-left: 40px;
    padding-top: 0px;
    color: white;
}
.about-content{
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
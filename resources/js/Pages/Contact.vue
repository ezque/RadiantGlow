<template>
    <div class="contact-body">
        <Header />
        <div class="contact-main">
            <div class="contact-con">
                <div class="contact-header">
                    <h2>CONTACT US</h2>
                </div>
                <div class="contact-content">
                    <div class="content">
                        <a class="content1">
                            <img class="logo" src="/public/image/facebook.png" alt="img">
                            <img class="name" src="/public/image/Facebook-name.png" alt="img">
                            <p class="content1-p">:  <u>@Radiant Glow</u></p>
                        </a>
                        <a class="content2">
                            <img class="logo1" src="/public/image/mail.png" alt="img">
                            <img class="name1" src="/public/image/mail-name.png" alt="img">
                            <p class="content2-p">radiantglow@gmail.com</p>
                        </a>
                        <a class="content3">
                            <img class="logo2" src="/public/image/call.png" alt="img">
                            <img class="name2" src="/public/image/call-name.png" alt="img">
                            <p class="content3-p">0965-456-8976</p>
                        </a>
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
.contact-body{
    background-image: url('/image/background.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    overflow: hidden;
    margin: 0;
}
.contact-main{
    margin-top: 100px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.contact-con{
    width: 80%;
    height: 80%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #672F2F;
    opacity: 87%;
    border-radius: 20px;
    margin-bottom: 100px;
}
.contact-header{
    width: 100%;
    height: 10%;
    display: flex;
    margin-top: 30px;
}
.contact-header h2{
    font-size: 1.9em;
    padding-left: 40px;
    padding-top: 0px;
    color: white;
}
.contact-content{
    width: 100%;
    height: 80%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 15px;
}
.content{
    width: 60%;
    height: auto;
    display: flex;
    font-size: 1.2em;   
    color: white;
    flex-direction: column;
    margin-top: -5%;
    margin-left: -36%;
}
.content a{
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}
.logo{
    width: 15%;
    height: auto;
    border-radius: 50%;
}
.name{
    margin-top: -10px;
    margin-left: -20px;
    width: 30%;
    height: auto;
    border-radius: 50%;
}
.content1-p{
    font-size: 1.2em;  
    text-align: justify;
    color: white;
    flex-direction: row;
    text-decoration: none;
    margin-left: -7px;
    font-style: italic;
}
.content1{
    width: 70%;
    height: auto;
    display: flex;
    font-size: 1.2em;   
    color: white;
    flex-direction: row;
}
.content2{
    width: 70%;
    height: auto;
    display: flex;
    font-size: 1.2em;   
    color: white;
    flex-direction: row;
    margin-top: 20px;
    margin-left: 25%;
}
.logo1{
    width: 15%;
    height: auto;
    border-radius: 50%;
}
.name1{
    margin-top: -10px;
    margin-left: -40px;
    width: 30%;
    height: auto;
    border-radius: 50%;
}
.content2-p{
    font-size: 1.2em;  
    text-align: justify;
    color: white;
    flex-direction: row;
    text-decoration: underline;
    margin-left:-15px;
    font-style: italic;
}
.content3{
    width: 110%;
    height: auto;
    display: flex;
    font-size: 1.2em;   
    color: white;
    flex-direction: row;
    margin-top: 20px;
    margin-left: 55%;
}
.logo2{
    width: 15%;
    height: auto;
    border-radius: 50%;
}
.name2{
    margin-top: -10px;
    margin-left:-5px;
    width: 50%;
    height: auto;
    border-radius: 50%;
}
.content3-p{
    font-size: 1.2em;  
    text-align: justify;
    color: white;
    flex-direction: row;
    text-decoration: underline;
    margin-left:10px;
    font-style: italic;
    width: auto;
}
</style>
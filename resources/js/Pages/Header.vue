<template>
    <header>
        <div class="header-logo-con">
            <img src="/public/image/radiant-white.png" alt="radiant">
        </div>
        <ul class="header-a">
            <li :class="{ active: isActive('/') }"><Link href="/">Home</Link></li>
            <li :class="{ active: isActive('/about') }"><Link href="/about">About</Link></li>
            <li :class="{ active: isActive('/services') }"><Link href="/services">Services</Link></li>
            <li :class="{ active: isActive('/contact') }"><Link href="/contact">Contact</Link></li>
        </ul>
        <div class="header-buttons-con">
            <Link href="/login" class="header-login">Login</Link>
            <Link href="/register" class="header-register">Register</Link>
        </div>
    </header>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';

// Using usePage to get the current URL
const page = usePage();
console.log("Page data:", page); // Log the entire page data to see what is available

const url = page.url; // Ensure you access the URL from the page data

const isActive = (pagePath) => {
    console.log("Current URL:", url); // Log the current URL for debugging
    console.log("Checking against:", pagePath); // Log what you are comparing against
    return url === pagePath; // Compare the current URL with the provided page
};
</script>

<style scoped>
header {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: fixed;
    margin: 0;
    padding: 0;
}

.header-logo-con {
    width: 15%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-logo-con img {
    width: 100%;
    height: auto;
}

.header-a {
    width: 35%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    list-style: none;
    padding: 0;
    margin: 0;
}

.header-a li {
    position: relative;
}

.header-a li a {
    text-decoration: none;
    color: white;
    font-size: 1.5em;
    position: relative; /* Needed for the after pseudo-element */
}

.header-a li.active a {
    color: white; /* Active link color */
    font-weight: bold; /* Optionally make active link bold */
}

/* Add underline only for active links */
.header-a li.active a::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: -5px; /* Adjust this value as needed */
    height: 3px; /* Thickness of the underline */
    background-color: white; /* Color of the underline */
    transform: scaleX(1); /* Scale to full size when active */
}

.header-a li a::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: -5px; /* Adjust this value as needed */
    height: 3px; /* Thickness of the underline */
    background-color: transparent; /* Initially transparent */
    transform: scaleX(0); /* Initially scale down to 0 */
    transition: transform 0.3s ease; /* Smooth transition */
}

.header-buttons-con {
    width: 15%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-buttons-con a {
    text-decoration: none;
    color: black;
    font-size: 1.2em;
    background-color: white;
    margin: 10px;
    width: 90px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
}
</style>

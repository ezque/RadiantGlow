<template>
    <header>
      <div class="header-con">
        <div class="--header-image" >
          <img @click="emitBackToDashboard" src="/public/image/radiant-white.png" alt="radiant">
        </div>
        <div class="--header-navbar">
          <a href="#" @click.prevent="toggleNotifications">
            <img src="/public/image/header-bell.png" alt="icon" />
            <span v-if="notificationCount > 0" class="notif-badge">{{ notificationCount }}</span>
          </a>
          <a href="#" id="toggle-settings" @click.prevent="emitShowSettings"><img src="/public/image/header-settiings.png" alt="settings"></a>
          <a href="#" @click.prevent="emitShowProfile"><img src="/public/image/header-profile.png" alt="profile" ></a>
          <a href="#" @click.prevent="handleLogout"><img src="/public/image/header-logout.png" alt="logout"></a>
        </div>
        <div class="notification-box" v-if="showNotifications">
          <div class="notification-label">
            <h2>Notifications</h2>
          </div>

          <ul class="notification-list">
            <li
              v-for="notification in sortedNotifications"
              :key="notification.id"
              :class="{ 'notification-item': true, unread: !notification.is_read }"
            >
              <span>{{ notification.message }}</span>
              <button
                v-if="!notification.is_read"
                @click="markAsRead(notification.id)"
                class="mark-read-btn"
              >
                Mark as Read
              </button>
            </li>
          </ul>
        </div>
      </div>
    </header>
  </template>
  
<script setup>
import { defineEmits, ref, computed } from 'vue';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  notifications: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits();
const emitShowProfile = () => {
  emit('showProfile');
};

const emitBackToDashboard = () => {
  emit('backToDashboard');
};

const emitShowSettings = () => {
  emit('showSettings');
};
const handleLogout = async () => {
try {
  await axios.post('/logout');
  window.location.href = '/login';
} catch (error) {
  console.error('Logout failed:', error);
}
};


const showNotifications = ref(false);

const sortedNotifications = computed(() => {
  return props.notifications.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
});

const notificationCount = computed(() => sortedNotifications.value.filter((n) => !n.is_read).length);

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value;
};

const markAsRead = async (id) => {
  try {
    // Mark the notification as read in the backend
    await Inertia.post('/notifications/read', { id });

    // Find the notification in the local list and update its `is_read` status
    const notification = sortedNotifications.value.find((n) => n.id === id);
    if (notification) {
      notification.is_read = true;
    }
  } catch (error) {
    console.error('Failed to mark as read', error);
  }
};
</script>
  

<style scoped>  
header{
    height: 10%;
    display: flex;
    justify-content: center;
}
.header-con{
    width: 80%;
    height: 100%;
    background-color: #986D4D;
    border-radius: 0 0 30px 30px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    position: relative;
}
.--header-image{
    width: 20%;
    height: 100%;
    display: flex;
    align-items: center;
}
.--header-image img{
    width: 70%;
    height: auto;
    cursor: pointer;
}
.--header-navbar{
    width: 20%;
    height: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-evenly;
}
.--header-navbar a{
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}
.--header-navbar a img{
    width: 70%;
    height: auto;
}
.notification-box {
  position: absolute;
  width: 250px;
  max-height: 400px;
  border: none;
  border-radius: 20px;
  top: 50px;
  right: 0;
  padding: 10px;
  background-color: #986d4d;
  overflow-y: auto;
  z-index: 99;
}
.notification-label {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  border-bottom: 1px solid black;
}
.notification-label h2 {
  font-size: 1.5em;
  font-weight: bold;
  color: black;
  margin: 0;
}
.notification-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.notification-item {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.notification-item.unread {
  background-color: #5a3d2e;
  font-weight: bold;
}
.mark-read-btn {
  background: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 0.9em;
  cursor: pointer;
}
.notif-badge {
  position: absolute;
  margin-left: 15px;
  margin-bottom: 15px;
  background: red;
  color: white;
  font-size: 12px;
  font-weight: bold;
  padding: 2px 6px;
  border-radius: 50%;
}
</style>
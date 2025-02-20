<template>
  <div class="notif-con">
    <a href="#" @click.prevent="toggleNotifications">
      <img src="/public/image/bell.png" alt="icon" />
      <span v-if="notificationCount > 0" class="notif-badge">{{ notificationCount }}</span>
    </a>

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
</template>

<script setup>
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';

// Props
const props = defineProps({
  notifications: {
    type: Array,
    required: true,
  },
});

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
.notif-con {
  display: flex;
  width: 100%;
  height: 50px;
  align-items: center;
  justify-content: end;
  position: relative;
}
.notif-con img {
  width: 30px;
  height: auto;
  margin-right: 10px;
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
  background-color: #5a3d2e; /* Darker highlight for unread notifications */
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
  top: -5px;
  right: 5px;
  background: red;
  color: white;
  font-size: 12px;
  font-weight: bold;
  padding: 2px 6px;
  border-radius: 50%;
}
</style>

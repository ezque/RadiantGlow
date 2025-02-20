<template>
  <div 
    class="category-card" 
    v-for="(category, index) in activeCategories" 
    :key="index"
  >
    <div 
      class="imageCon" 
      :style="{ backgroundImage: `url(${getImageUrl(category.image)})` }">
    </div>
    <div class="category-details">
      <h3>{{ category.categoryName }}</h3>
      <a href="#" @click.prevent="selectCategory(category)">View</a>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, computed } from 'vue';

const props = defineProps({
  categories: { type: Array, required: true },
});

const emits = defineEmits(['categorySelected']);

const activeCategories = computed(() => {
  return props.categories.filter(category => category.status === 'active');
});

const getImageUrl = (imagePath) => {
  return `/storage/${imagePath.replace('storage/', '')}`;
};

const selectCategory = (category) => {
  emits('categorySelected', category);
};

</script>


<style scoped>
.category-card{
  width: 160px;
  height: 200px;
  position: relative;
  display: flex;
  align-items: end;
  justify-content: center;
  transition: transform 0.2s ease-in-out;
}
.imageCon{
    width: 60%;
    height: 48%;
    position: absolute;
    top: 10px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;

}
.category-details{
    width: 100%;
    height: 70%;
    display: flex;
    flex-direction: column;
    justify-content: end;
    align-items: center;
    background-color: #986D4D;
    border-radius: 20px;
}
.category-details h3{
    color: white;
    font-size: 1rem;
    margin: 0;
    margin-bottom: 20px;
    font-style: italic;
    text-align: center;
}
.category-details a{
    color: white;
    text-decoration: none;
    font-family: 'arial';
    font-size: .8rem;
    margin-bottom: 20px;
    cursor: pointer;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
}
.category-details a:hover{
    font-weight: bold;
    background-color: #fff;
    border: #543727 solid 2px;
    color: #543727;
    transition: all 0.5s ease;
    
}

</style>
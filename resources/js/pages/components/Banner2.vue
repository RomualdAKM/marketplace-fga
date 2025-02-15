<template>
  <div class="slider" ref="slider">
    <div class="slider-wrapper" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
      <div class="slide" v-for="banner in banners" :key="banner.id">
        <div class="image-container">
          <img :src="'/storage/' + banner.image" alt="">
          <div class="text-container">
            <div class="single-hero-slider-inner">
              <h5 class="sub-title">{{ banner.name }}</h5>
              <h1 class="title">{{ banner.description }}</h1>
              <a class="slideshow-button" href="/#products">Achetez maintenant <i class="icon-rt-arrow-right-solid"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button class="prev" @click="prevSlide">❮</button>
    <button class="next" @click="nextSlide">❯</button>
    <div class="pagination">
      <span v-for="(banner, index) in banners" :key="banner.id" :class="{ active: index === currentSlide }" @click="goToSlide(index)"></span>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import axios from 'axios'

const banners = ref([])
const currentSlide = ref(0)
let interval = null

const getBanners = async () => {
  try {
    const response = await axios.get('/api/get_banners')
    banners.value = response.data
    console.log('banners', response.data)
  } catch (error) {
    console.error('Error fetching banners:', error)
  }
}

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % banners.value.length
}

const prevSlide = () => {
  currentSlide.value = (currentSlide.value - 1 + banners.value.length) % banners.value.length
}

const goToSlide = (index) => {
  currentSlide.value = index
}

const startAutoplay = () => {
  interval = setInterval(nextSlide, 5000)
}

const stopAutoplay = () => {
  if (interval) {
    clearInterval(interval)
  }
}

onMounted(async () => {
  await getBanners()
  startAutoplay()
})

onUnmounted(() => {
  stopAutoplay()
})
</script>

<style scoped>
.slider {
  position: relative;
  overflow: hidden;
  width: 100%;
  height: 600px;
}

.slider-wrapper {
  display: flex;
  transition: transform 0.8s ease-in-out;
}

.slide {
  min-width: 100%;
  box-sizing: border-box;
  position: relative;
}

.image-container {
  width: 100%;
  height: 600px;
  position: relative;
  overflow: hidden;
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.9);
  transition: transform 0.5s ease;
}

.slide:hover .image-container img {
  transform: scale(1.05);
}


.text-container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: white;
  padding: 30px;
  border-radius: 10px;
  width: 80%;
 
  /* backdrop-filter: blur(5px); */
}

.single-hero-slider-inner {
  max-width: 800px;
  margin: 0 auto;
}

.single-hero-slider-inner .sub-title {
  font-size: 28px;
  margin-bottom: 15px;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-weight: 300;
}

.single-hero-slider-inner .title {
  font-size: 54px;
  margin-bottom: 25px;
  line-height: 1.2;
  font-weight: 700;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.slideshow-button {
  padding: 15px 30px;
  background-color: #ff6347;
  color: white;
  text-decoration: none;
  border-radius: 30px;
  transition: all 0.3s;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.slideshow-button:hover {
  background-color: #e5533d;
  transform: translateY(-2px);
  box-shadow: 0 6px 8px rgba(0,0,0,0.15);
}

.prev,
.next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(255, 255, 255, 0.2);
  color: white;
  border: none;
  padding: 15px;
  cursor: pointer;
  z-index: 10;
  border-radius: 50%;
  font-size: 24px;
  transition: all 0.3s;
}

.prev {
  left: 20px;
}

.next {
  right: 20px;
}

.prev:hover,
.next:hover {
  background-color: rgba(255, 255, 255, 0.4);
}

.pagination {
  position: absolute;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 15px;
}

.pagination span {
  width: 14px;
  height: 14px;
  background-color: rgba(255, 255, 255, 0.5);
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s;
}

.pagination .active {
  background-color: #ff6347;
  transform: scale(1.2);
}

.pagination span:hover {
  background-color: rgba(255, 255, 255, 0.8);
}
</style>
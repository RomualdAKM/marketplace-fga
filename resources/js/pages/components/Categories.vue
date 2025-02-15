<script setup>
import { ref,onMounted } from 'vue';

const currentIndex = ref(0);
let categories = ref([])


const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % categories.value.length;
};

const prevSlide = () => {
  currentIndex.value = (currentIndex.value - 1 + categories.value.length) % categories.value.length;
};



const getCategories = async () => {
    const response = await axios.get('/api/get_categories')
    categories.value = response.data
    console.log('categories',response.data)
}

onMounted (async() => {
  await  getCategories()

})
</script>

<template>
  <section id="category" class="category-section section-space-ptb-90">
    
    <div class="container">
      <div class="row">
                <div class="col-12 position-relative">
                    <div class="section-title-two text-center mb-30">
                        <h3 class="sub-title">Categories</h3>
                       
                    </div>
                </div>
            </div>
      <div class="slider">
        <button type="button" @click="prevSlide" class="slick-prev slick-arrow">
          <i class="icon-rt-arrow-left-solid"></i>
        </button>
        <div class="slider-track-container">
          <div class="slider-track" :style="{ transform: `translateX(-${currentIndex * 232}px)` }">
            <div class="single-category text-center" v-for="(item, index) in categories" :key="index">
              <h5 class="category-name fw-semibold mb-4">{{ item.name }}</h5>
              <div class="category-image">
                <router-link to="/products"><img :src="'/storage/' + item.image" alt=""></router-link>
              </div>
              <span>{{ item.description }}</span>
              <div class="category-content">
                <p>{{ item.products_count }} Produit(s)</p>
              </div>
            </div>
          </div>
        </div>
        <button type="button" @click="nextSlide" class="slick-next slick-arrow">
          <i class="icon-rt-arrow-right-solid"></i>
        </button>
      </div>
    </div>
  </section>
</template>

<style scoped>
.slider {
  position: relative;
  overflow: hidden;
  width: 100%;
}

.slider-track-container {
  overflow: hidden;
  width: 100%;
}

.slider-track {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.single-category {
  flex: 0 0 auto;
  width: 232px;
}

.slick-prev,
.slick-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  border: none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2;
  transition: background 0.3s ease;
}

.slick-prev:hover,
.slick-next:hover {
  background: rgba(0, 0, 0, 0.7);
}

.slick-prev:focus,
.slick-next:focus {
  outline: none;
}

.slick-prev {
  left: 10px;
}

.slick-next {
  right: 10px;
}

.slick-prev i,
.slick-next i {
  font-size: 20px;
}
</style>

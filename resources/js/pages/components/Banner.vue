<script setup>
import { ref, reactive, onMounted,onUnmounted } from "vue";

const props = defineProps({
    schoolSlug: String 
  })

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

const activeIndex = ref(0);
	const animated = ref(false);
	let intervalId;
  
	const setActiveSlide = (index) => {
	  animated.value = true;
	  setTimeout(() => {
		activeIndex.value = index;
		animated.value = false;
	  }, 500);
	}
  
	const prevSlide = () => {
	  animated.value = true;
	  setTimeout(() => {
		activeIndex.value = (activeIndex.value - 1 + slides.length) % slides.length;
		animated.value = false;
	  }, 500);
	}
  
	const nextSlide = () => {
	  animated.value = true;
	  setTimeout(() => {
		activeIndex.value = (activeIndex.value + 1) % slides.length;
		animated.value = false;
	  }, 500);
	}
  
	const slides = reactive([]);
	const indicators = reactive([]);


onMounted( async () => {
		await getBanners();
		if (banners.value.length > 0) {

			for (let i = 0; i < banners.value.length; i++) {
        slides.push({ image: '/storage/' + banners.value[i].image, title: banners.value[i].name, description: banners.value[i].description });
        indicators.push({ image: '/storage/' + banners.value[i].image });
    		}
			
		}else{
			slides.push({ image: '/banner.webp', title: "shop", description: "votre meileur boutique" });
			slides.push({ image: '/banner.webp', title: "shop", description: "votre meileur boutique" });
			slides.push({ image: '/banner.webp', title: "shop", description: "votre meileur boutique" });
			indicators.push({ image: '/banner.webp'})
			indicators.push({ image: '/banner.webp'})
			indicators.push({ image: '/banner.webp'})
		}
		console.log('slides',slides)
		intervalId = setInterval(() => {
		activeIndex.value = (activeIndex.value + 1) % slides.length;
	  }, 5000); // Changer cette valeur pour ajuster le délai entre les diapositives
		
	});

	onUnmounted(() => {
	  clearInterval(intervalId); // Arrête le défilement automatique lorsque le composant est démonté
	});

</script>


<template>
	<section class="home">
	  <div id="carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-controls">
		  <ol class="carousel-indicators">
			<li v-for="(indicator, index) in indicators" :key="index" :class="{ active: index === activeIndex }" @click="setActiveSlide(index)" :style="{ backgroundImage: 'url(' + indicator.image + ')' }"></li>
		  </ol>
		  <a class="carousel-control-prev" href="#" role="button" @click.prevent="prevSlide">
			<img src="/img/left-arrow.svg" alt="Prev"> 
		  </a>
		  <a class="carousel-control-next" href="#" role="button" @click.prevent="nextSlide">
			<img src="/img/right-arrow.svg" alt="Next">
		  </a>
		</div>
		<div class="carousel-inner" >
		  <div  v-for="(item, index) in slides" :key="index" :class="{ 'carousel-item': true, active: index === activeIndex }" :style="{ backgroundImage: 'url(' + item.image + ')' }">
			<div class="container" >
			  <h2>{{ item.title }}</h2>
			  <p v-html="item.description"></p>
			</div>
		  </div>
		</div>
	  </div>
	</section>
										
</template>

<style scoped>
.home .carousel-item{
	min-height: 90vh;
	background-position: center;
	background-size: cover;
	position: relative;
	z-index: 1;
}
.home .carousel-item:before{
	content: '';
	position: absolute;
	left:0;
	top:0;
	width: 100%;
	height: 100%;
	background-color: rgba(0,0,0,0.5);
	z-index: -1;
}
.home .carousel-item .container{
	position: absolute;
	left: 50%;
	top:50%;
	transform: translate(-50%,-50%);
	text-align: center;
}
.home .carousel-item h2{
	font-size: 80px;
	color: #ffffff;
	margin:0 0 10px;
	opacity: 0;
}
.home .carousel-item p{
	font-size: 30px;
	margin:0;
	color: #eeeeee;
	opacity:0;
}
.home .carousel-item.active h2{
	animation: fadeInLeft 1s ease forwards;
}
.home .carousel-item.active p{
	animation: fadeInRight 2s ease forwards;
}

@keyframes fadeInLeft{
	0%{
		opacity: 0;
		transform: translateX(-30px);
	}
	100%{
		opacity: 1;
		transform: translateX(0px);
	}
}
@keyframes fadeInRight{
	0%{
		opacity: 0;
		transform: translateX(30px);
	}
	100%{
		opacity: 1;
		transform: translateX(0px);
	}
}

.home .carousel-controls{
	position: absolute;
	left: 50%;
	bottom: 40px;
	z-index: 10;
	transform: translateX(-50%);
}

.home .carousel-indicators{
	position: relative;
	margin:0;
}

.home .carousel-indicators li{
	height: 70px;
	width: 70px;
	margin:0 5px;
	border-radius: 50%;
	background-position: center;
	background-size: cover;
	border:3px solid transparent;
	transition: all 0.3s ease;
}
.home .carousel-indicators li.active{
	border-color: #ffffff;
	transform: scale(1.2);
}

.home .carousel-control-next, 
.home .carousel-control-prev{
	height: 60px;
	width: 60px;
	opacity: 1;
	z-index: 3;
	top: 50%;
	transform: translateY(-50%);
	border-radius: 50%;
	transition: all 0.3s ease;
}
.home .carousel-control-next:hover, 
.home .carousel-control-prev:hover{
   box-shadow: 0 0 10px #ffffff;
}
.home .carousel-control-next img, 
.home .carousel-control-prev img{
   width: 30px;
}
.home .carousel-control-next{
	right: -90px;
}
.home .carousel-control-prev{
	left: -90px;
}

/*responsive*/
@media(max-width: 767px){
  .home .carousel-control-next, 
  .home .carousel-control-prev{
  	display: none;
  }
  .home .carousel-indicators li{
  	height: 60px;
  	width: 60px;
  }
  .home .carousel-item h2{
  	font-size: 45px;
  }
  .home .carousel-item p{
  	font-size: 22px;
  }
}






</style>

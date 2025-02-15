<script setup>
import { ref, onMounted, computed } from 'vue';
import WishlistButton from './WishlistButton.vue'
import axios from 'axios';

let products = ref([]);
const shop = ref('')

const getNewProducts = async () => {
    const response = await axios.get('/api/get_new_products');
    products.value = response.data;
    console.log('products', response.data);
};

// Calcul de la note moyenne pour chaque produit
const averageRating = (reviews) => {
  if (!reviews || !reviews.length) return 0;
  const total = reviews.reduce((sum, review) => sum + review.rating, 0);
  return (total / reviews.length).toFixed(1);
};

const getShop = async () => {
    await axios
        .get("/api/get_shop")
        .then((res) => {
            if (res.data) {

                shop.value = res.data;
            }

            console.log("shop", shop.value);
        })
        .catch((err) => {
            console.log(err);
        });
};

onMounted(async () => {
    await getShop();
    await getNewProducts();
});

</script>

<template>
    <section class="product-item-section pb-5" id="products">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative">
                    <div class="section-title-two text-center mb-30">
                        <h3 class="sub-title">Nouveautés</h3>
                        <h2 class="section-title">Nos produits</h2>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-center">
                <div v-for="product in products" :key="product.id" class="single-product-item--three" style="width: 300px; margin:10px;">
                    <div class="single-product-item-image">
                        <a href="#" class="prodcut-images" tabindex="-1">
                            <img class="primary-image" v-if="product.productimages[0].image_url" :src="'/storage/' + product.productimages[0].image_url" alt="" style="width: 100%; height: 200px;">

                            <img class="secondary-image"  v-if="product.productimages[0].image_url"  :src="'/storage/' + product.productimages[0].image_url" alt="" style="width: 100%; height: 200px;">
                        </a>
                        <ul class="single-product-item-action">
                                <li class="single-product-item-action-list">
                                   <WishlistButton :productId="product.id" />
                                 
                                </li>
                                <li class="single-product-item-action-list">
                                    <router-link :to="{name:'ShowProduct', params:{productId:product.id}}" class="single-product-item-action-link" tabindex="0"><i class="icon-rt-eye2"></i></router-link>
                                </li>
                            </ul>
                    </div>
                    <div class="single-product-item-content">
                        <div class="single-product-item-rating">
                            <!-- <i class="icon-rt-star-solid select-star"></i> -->
                          
                                <a href="#" v-for="star in 5" :key="star"><i class="icon-rt-star-solid" :class="{ 'select-star': star <= averageRating(product.reviews) }"></i></a>
                          
                        </div>
                        <h6 class="single-product-item-title">
                            <router-link :to="{name:'ShowProduct', params:{productId:product.id}}" tabindex="-1">{{ product.name }}</router-link>
                        </h6>
                        <div class="single-product-item-price" >
                          {{ product.base_price }} <span v-if="shop.devise">{{shop.devise}}</span>
                        </div>
                        <div class="single-product-item-action-cart">
                            
                                <router-link :to="{name:'ShowProduct', params:{productId:product.id}}" tabindex="0"><span class="text">Ajouter au panier</span></router-link>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
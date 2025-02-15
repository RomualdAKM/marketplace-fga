<script setup>
import { ref, onMounted, computed } from 'vue';
import Header from '../components/Header.vue';
import Reviews from '../components/Reviews.vue';
import Footer from '../components/Footer.vue';
import { useRoute } from 'vue-router';
import { useCartStore } from '../../stores/cart';
import axios from 'axios';

const route = useRoute();
const cartStore = useCartStore();

const productId = ref(route.params.productId);
const product = ref(null);
const quantity = ref(1);
const selectedOptions = ref([]);
const largeImage = ref('');

// Récupérer les avis pour calculer la moyenne
const reviews = ref([]);

const getProduct = async () => {
  try {
    let response = await axios.get(`/api/get_product/${productId.value}`);
    product.value = response.data;

    // Assurons-nous que base_price est un nombre
    product.value.base_price = parseFloat(product.value.base_price);
    
    console.log('product', product.value);

    // Initialize selectedOptions with the first option of each variant
    if (product.value.productvariations) {
      selectedOptions.value = product.value.productvariations.map(
        (variant) => {
          // Assurons-nous que additional_price est un nombre
          variant.productvariationoptions.forEach(option => {
            option.additional_price = parseFloat(option.additional_price);
          });
          return variant.productvariationoptions[0];
        }
      );
    }

    // Set the large image to the first product image
    if (product.value.productimages && product.value.productimages.length > 0) {
      largeImage.value = product.value.productimages[0].image_url;
    }

    // Récupérer les avis
    if (product.value.reviews) {
      reviews.value = product.value.reviews;
    }
  } catch (error) {
    console.error('Error fetching product data:', error);
  }
};

const updateLargeImage = (imageUrl) => {
  largeImage.value = imageUrl;
};

const increaseQuantity = () => {
  quantity.value++;
};

const decreaseQuantity = () => {
  if (quantity.value > 1) {
    quantity.value--;
  }
};

const addToCart = () => {
  if (quantity.value > product.value.stock) {
    toast.fire({
                icon: "error",
                title: "La quantité sélectionnée dépasse le stock disponible (" + product.value.stock + ")",
            });
    return;
  }
  cartStore.addToCart(product.value, quantity.value, selectedOptions.value);
};

const selectOption = (varIndex, option) => {
  selectedOptions.value[varIndex] = option;
};

const totalPrice = computed(() => {
  if (!product.value) return 0;
  const basePrice = product.value.base_price || 0;
  const optionsTotal = selectedOptions.value.reduce((total, option) => {
    return total + (option.additional_price || 0);
  }, 0);
  return (basePrice + optionsTotal);
});
const shop = ref('')

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


// Calculer la moyenne des évaluations
const averageRating = computed(() => {
  if (!reviews.value.length) return 0;
  const total = reviews.value.reduce((sum, review) => sum + review.rating, 0);
  return (total / reviews.value.length).toFixed(1);
});

onMounted(async () => {
  await getShop();
  await getProduct();
});
</script>

<template>
  <Header />

  <main>
    <section class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="breadcrumb-content">
              <h1 class="page-title">Produit</h1>
              <ul class="breadcrumb-page-list">
                <li class="breadcrumb-item"><router-link to="/">Accueil</router-link></li>
                <li class="breadcrumb-item">Produit</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="product-details-section section-space-pt">
      <div class="container" v-if="product">
        <div class="row">
          <div class="col-md-6">
            <!-- Product Details Left -->
            <div class="product-details-left">
              <div class="product-details-images">
                <div class="large-image">
                  <img :src="'/storage/' + largeImage" alt="product image" />
                </div>
                <div class="product-details-thumbs">
                  <div
                    v-for="(image, index) in product.productimages"
                    :key="index"
                    class="thumb-image"
                  >
                    <img
                      :src="'/storage/' + image.image_url"
                      alt="product image thumb"
                      @click="updateLargeImage(image.image_url)"
                    />
                  </div>
                </div>
              </div>
            </div>
            <!--// Product Details Left -->
          </div>
          <div class="col-md-6">
            <div class="product-details-view-content">
              <h3 class="title">{{ product.name }}</h3>
              <div class="product-rating d-flex">
                <ul class="d-flex">
                  <li v-for="star in 5" :key="star">
                    <a href="#"><i class="icon-rt-star-solid" :class="{ 'select-star': star <= averageRating }"></i></a>
                  </li>
                </ul>
                <a href="#" class="rating-count">
                  (<span class="count">{{ reviews.length }}</span> avis des clients)
                </a>
              </div>
              
              <p class="product-details-view-desc" v-html="product.description"></p>

              <div class="stock in-stock">{{ product.stock }} en stock</div>
              <div class="price-box">
                <span class="new-price">{{ totalPrice }} <span v-if="shop.devise">{{shop.devise}}</span></span>
              </div>
              <h3>Les options</h3>
              <div class="pa_size" v-if="product.productvariations && product.productvariations.length > 0">
                <div
                  v-for="(variant, varIndex) in product.productvariations"
                  :key="varIndex"
                  class="variant"
                >
                  <label class="pa_size_label">{{ variant.name }}</label>
                  <div class="variant-options">
                    <span
                      v-for="(option, optIndex) in variant.productvariationoptions"
                      :key="optIndex"
                      :class="['packet-swatch-vareant', { active: selectedOptions[varIndex] === option }]"
                      @click="selectOption(varIndex, option)"
                    >
                      {{ option.name }} + {{ option.additional_price }} <span v-if="shop.devise">{{shop.devise}}</span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="single-add-to-cart">
                <form @submit.prevent="addToCart" class="cart-quantity d-flex">
                  <div class="quantity">
                    <div class="cart-plus-minus">
                      <div class="dec qtybutton" @click="decreaseQuantity">-</div>
                      <input
                        class="cart-plus-minus-box"
                        v-model="quantity"
                        type="text"
                      />
                      <div class="inc qtybutton" @click="increaseQuantity">+</div>
                    </div>
                  </div>
                  <button class="add-to-cart btn btn--primary md:px-5" type="submit">
                    
                    Ajouter au panier

                  </button>
                </form>
              </div>
              <div class="product-meta">
                <!-- <div class="sku_wrapper">
                  SKU: <span class="sku">{{ product.sku }}</span>
                </div> -->
                <div class="posted_in" v-if="product.category">
                  <span>Categorie: </span>
                  <a href="#">{{ product.category.name }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="d-flex justify-content-center">
      <div class="spinner-grow text-success" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
     
    </section>

    <Reviews :productId="productId"/>
    <Footer class="mt-5"/>
  </main>
</template>


<style scoped>
.container {
  max-width: 1200px;
  margin: auto;
}
.product-details-left {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.product-details-images .large-image img {
  width: 100%;
  height: auto;
}
.product-details-thumbs {
  display: flex;
  justify-content: center;
  margin-top: 15px;
}
.product-details-thumbs .thumb-image {
  margin: 0 5px;
}
.product-details-thumbs .thumb-image img {
  width: 60px;
  height: auto;
  cursor: pointer;
}
.product-variant .variant-label {
  margin-right: 10px;
}
.product-variant .variant-options {
  display: flex;
}
.packet-swatch-vareant {
  margin-right: 10px;
  padding: 5px 10px;
  border: 1px solid #ccc;
  cursor: pointer;
}
.packet-swatch-vareant.active {
  border-color: green;
}
.price-box {
  display: flex;
  align-items: center;
}
.price-box .new-price {
  color: red;
  font-weight: bold;
  margin-right: 10px;
}
.price-box .old-price {
  text-decoration: line-through;
  color: grey;
}
</style>

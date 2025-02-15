<template>
    <Header />
    <main>
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="page-title">Produits</h1>
                            <ul class="breadcrumb-page-list">
                                <li class="breadcrumb-item"><router-link to="/">Accueil</router-link></li>
                                <li class="breadcrumb-item">Produits</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section-wrapper section-space-pb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 sidebar widget-area-side left-sidebar order-2 order-lg-1">
                        <div class="shop-widget">
                            <h5 class="widget-title">Filtrer par categories</h5>
                            <ul class="product-categorie">
                                <li class="product-categorie-item" v-for="(item, index) in categories" :key="index">
                                    <a href="#" @click.prevent="filterByCategory(item.id)">{{ item.name }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="shop-widget">
                            <h5 class="widget-title">Filtrer par prix</h5>
                         
                            <div class="filter-price-content">
                                <vue-slider v-model="priceRange" :min="0" :max="maxPrice" :interval="5" :tooltip="'always'"></vue-slider>
                                <div class="filter-price-wapper">
                                    <div class="filter-price-cont">
                                        <span>Price:</span>
                                        <div class="input-type">
                                            <input type="text" v-model="priceRange[0]" readonly>
                                        </div>
                                        <span>—</span>
                                        <div class="input-type">
                                            <input type="text" v-model="priceRange[1]" readonly>
                                        </div>
                                    </div>
                                    <button class="add-to-cart-button" @click="filterByPrice">
                                        <span>Filtrer</span>
                                      
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button @click="resetFilters" class="btn btn-secondary mt-3">Réinitialiser les filtres</button>
                     
                    </div>
                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                        <div class="shop-toolbar-wrapper ms-lg-4 mb-3">
                            <div class="shop-toolbar-btn d-flex align-items-center">
                                <div class="page_amount ms-3">
                                    <input type="text" class="form-control" placeholder="filtrer par nom du produit" v-model="searchQuery">
                                </div>
                                <!-- <button @click="filterByName" class="btn btn--primary ms-2">Search</button> -->
                            </div>
                        </div>

                        <div class="shop-product-wrapper ms-lg-4 border-top border-start row gx-0 archive-products">
                            <div v-for="product in paginatedProducts" :key="product.id" class="single-product-item--three" style="width: 200px; margin:10px;">
                                <div class="single-product-item-image">
                                    <a href="#" class="product-images">
                                        <img class="primary-image" :src="'/storage/' + product.productimages[0].image_url" alt="" style="width: 100%; height: 200px;">
                                        <img class="secondary-image" :src="'/storage/' + product.productimages[0].image_url" alt="" style="width: 100%; height: 200px;">
                                    </a>
                                    <ul class="single-product-item-action">
                                        <li class="single-product-item-action-list">
                                            <WishlistButton :productId="product.id" />
                                        </li>
                                        <li class="single-product-item-action-list">
                                            <router-link :to="{name:'ShowProduct', params:{productId:product.id}}"  class="single-product-item-action-link"><i class="icon-rt-eye2"></i></router-link>
                                        </li>
                                        <li class="single-product-item-action-list product-cart">
                                            <router-link :to="{name:'ShowProduct', params:{productId:product.id}}" class="single-product-item-action-link"><i class="icon-rt-basket-outline"></i></router-link>
                                        </li>
                                    </ul>
                                </div>
                                <div class="single-product-item-content">
                                    <div class="single-product-item-rating">
                                        <a href="#" v-for="star in 5" :key="star"><i class="icon-rt-star-solid" :class="{ 'select-star': star <= averageRating(product.reviews) }"></i></a>

                                    </div>
                                    <h6 class="single-product-item-title"><router-link :to="{name:'ShowProduct', params:{productId:product.id}}">{{ product.name }}</router-link></h6>
                                    <div class="single-product-item-price">{{ product.base_price }}<span v-if="shop.devise">{{shop.devise}}</span></div>
                                </div>
                            </div>
                        </div>

                        <nav class="page-pagination">
                            <ul class="page-pagination-numbers">
                                <li><a href="#" @click.prevent="changePage(1)" class="page-numbers">Première</a></li>
                              
                                <li><a href="#" @click.prevent="changePage(currentPage - 1)" class="page-numbers" :class="{ disabled: currentPage === 1 }">Précédent</a></li>
                               
                               
                                <li v-for="page in totalPages" :key="page">
                                    <a href="#" @click.prevent="changePage(page)" class="page-numbers" :class="{ current: currentPage === page }">{{ page }}</a>
                                </li>
                                <li><a href="#" @click.prevent="changePage(currentPage + 1)" class="page-numbers" :class="{ disabled: currentPage === totalPages }">Suivant</a></li>
                               
                                <li><a href="#" @click.prevent="changePage(totalPages)" class="page-numbers">Fin</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    <Footer class="mt-5"/>

    </main>
</template>
<script setup>
import Header from '../components/Header.vue';
import { ref, onMounted, computed } from 'vue';
import VueSlider from 'vue-slider-component';
import 'vue-slider-component/theme/default.css';
import Footer from '../components/Footer.vue';
import WishlistButton from './../components/WishlistButton.vue'

import axios from 'axios';

let products = ref([]);
let categories = ref([]);
let searchQuery = ref('');
let selectedCategory = ref(null);
let priceRange = ref([0, 11500]);
let maxPrice = ref('')

let currentPage = ref(1);
let itemsPerPage = ref(10);

const getAllProducts = async () => {
    const response = await axios.get('/api/get_all_products');
    products.value = response.data;
    const maxBasePrice = Math.max(...response.data.map(product => product.base_price));
    priceRange.value = [0, maxBasePrice];
    maxPrice.value = maxBasePrice;
    console.log('max base price', maxBasePrice);
};


const getCategories = async () => {
    const response = await axios.get('/api/get_categories');
    categories.value = response.data;
    console.log('categories', response.data);
};
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
const filterByName = () => {
    applyFilters();
};

const filterByCategory = (categoryId) => {
    selectedCategory.value = categoryId;
    applyFilters();
};

const filterByPrice = () => {
    applyFilters();
};

const applyFilters = () => {
    filteredProducts.value = products.value.filter(product => {
        let matchesCategory = true;
        let matchesPrice = true;

        if (selectedCategory.value) {
            matchesCategory = product.category_id === selectedCategory.value;
        }

        if (priceRange.value.length === 2) {
            const productPrice = parseFloat(product.base_price);
            matchesPrice = productPrice >= priceRange.value[0] && productPrice <= priceRange.value[1];
        }

        return matchesCategory && matchesPrice && product.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    });
};

const resetFilters = () => {
    getAllProducts()
    searchQuery.value = '';
    selectedCategory.value = null;
    applyFilters();
};

const filteredProducts = computed(() => {
    let filtered = products.value;

    if (searchQuery.value) {
        filtered = filtered.filter(product =>
            product.name.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    }

    if (selectedCategory.value) {
        filtered = filtered.filter(product => product.category_id === selectedCategory.value);
    }

    if (priceRange.value.length === 2) {
        filtered = filtered.filter(product => {
            const productPrice = parseFloat(product.base_price);
            return productPrice >= priceRange.value[0] && productPrice <= priceRange.value[1];
        });
    }

    return filtered;
});

const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return filteredProducts.value.slice(start, end);
});

const totalPages = computed(() => {
    return Math.ceil(filteredProducts.value.length / itemsPerPage.value);
});

const changePage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
};

// Calcul de la note moyenne pour chaque produit
const averageRating = (reviews) => {
  if (!reviews || !reviews.length) return 0;
  const total = reviews.reduce((sum, review) => sum + review.rating, 0);
  return (total / reviews.length).toFixed(1);
};

onMounted(async () => {
    await getShop();
    await getAllProducts();
   
    await getCategories();
});
</script>
  <style scoped>
  .container {
    max-width: 1200px;
    margin: auto;
  }

  .filter-price-content {
  margin: 20px 0;
}

.filter-price-wapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 10px;
}

.filter-price-cont {
  display: flex;
  align-items: center;
}

.input-type {
  margin: 0 10px;
}

.add-to-cart-button {
  background-color: #333;
  color: white;
  padding: 5px 10px;
  border: none;
  cursor: pointer;
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
  
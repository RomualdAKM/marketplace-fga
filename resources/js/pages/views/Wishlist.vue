<script setup>
import { ref, onMounted } from 'vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';


const wishlists = ref({})
const getWishlists = async () => {
    await axios
        .get("/api/get_wishlists")
        .then((res) => {
            if (res.data) {

                wishlists.value = res.data;
            }

            console.log("wishlists", wishlists.value);
        })
        .catch((err) => {
            console.log(err);
        });
};

const getImageUrl = (productImages) => {
  return productImages.length ? productImages[0].image_url : '/storage/';
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


onMounted(async () => {
    await getShop();
    await getWishlists();
});
</script>

<template>
     <Header />
     <main>
        <section class="breadcrumb-section-two">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h2 class="visually-hidden">Liste de souhaits</h2>
                            <ul class="breadcrumb-page-list">
                                <li class="breadcrumb-item"><router-link to="/">Accueil</router-link></li>
                                <li class="breadcrumb-item"><span class="active">Liste de souhaits</span></li>
                              
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-secton-wrapper section-space-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wishlist-tiel">
                            <h2 class="mb-5 fw-bold">Liste de souhaits</h2>
                        </div>
                        <form action="#" class="cart-table">
                            <div class=" table-content table-responsive">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th class="plantmore-product-thumbnail">Images</th>
                                            <th class="cart-product-name">Produit</th>
                                            <th class="plantmore-product-price">Prix de base</th>
                                            <th class="plantmore-product-stock-status">Statut en stock</th>
                                          
                                            <th class="plantmore-product-add-cart">Voir</th>
                                            <!-- {/* <th class="plantmore-product-remove">Remove</th> */} -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in wishlists" :key="item.id">
                                            <td class="plantmore-product-thumbnail"><a href="#"><img :src="'/storage/' + getImageUrl(item.product.productimages)" style="max-width: 100px;" alt=""></a></td>
                                            <td class="plantmore-product-name"><a href="#">{{ item.product.name }}</a></td>
                                            <td class="plantmore-product-price"><span class="amount">{{ item.product.base_price }} {{shop.devise}}</span></td>
                                            <td class="plantmore-product-stock-status"><span class="in-stock">{{ item.product.stock }}</span></td>
                                            <td class="plantmore-product-add-cart"><router-link :to="{name:'ShowProduct', params:{productId:item.product.id}}" class="btn btn--primary btn--small">voir</router-link></td>
                                            <!-- {/* <td class="plantmore-product-remove"><a href="#"><i class="icon-rt-close-outline"></i></a></td> */} -->
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <Footer class="mt-5"/>
     </main>
</template>
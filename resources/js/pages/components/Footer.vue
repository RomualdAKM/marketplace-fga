<script setup>
import { ref, reactive, onMounted } from "vue";
import { useCartStore } from '../../stores/cart';
  

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

});


</script>


<template>
    <footer class="footer-section border-top">
        <div class="footer-top-area pt-4 section-space-pb border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="/"><img :src="'/storage/'+shop.logo" alt="" style="max-width: 60px;"></a>
                            </div>
                            <ul class="footer-social-list">
                                <li v-if="shop.facebook_link">
                                    <a :href="shop.facebook_link" target="_blank" class="facebook"><i class="icon-rt-4-facebook-f"></i></a>
                                </li>
                                <li v-if="shop.tiktok_link">
                                    <a :href="tiktok_link" target="_blank" class="twitter"><i class="icon-rt-logo-twitter"></i></a>
                                </li><li v-if="shop.instagram_link">
                                    <a :href="shop.instagram_link" target="_blank" class="instagram"><i class="icon-rt-logo-instagram"></i></a>
                                </li>
                                <li v-if="shop.youtube_link">
                                    <a :href="shop.youtube_link" target="_blank" class="youtube"><i class="icon-rt-2-youtube2"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="footer-widget">
                            <h6 class="footer-title">INFORMATION</h6>
                            <ul class="footer-list">
                                <li><router-link to="/contact">Nous contacter</router-link></li>
                                <li><router-link to="/about-shop">À propos de nous</router-link></li>
                                <li><router-link to="/confidentialitychop">Politique de confidentialité</router-link></li>
                                <li><router-link to="/conditionshop">Condition de vente générale</router-link></li>
                               
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="footer-widget">
                            <h6 class="footer-title">MON COMPTE</h6>
                           
                            <ul class="footer-list">
                                <li><router-link to="/my-account">Mes commandes</router-link></li>

                                <li><router-link to="/wishlist">Liste de souhaits</router-link></li>
                              
                                <!-- <li><router-link to="/my-account">Mes informations de compte</router-link></li> -->
                              
                            </ul>
                        </div>
                    </div>

                    <!-- <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="footer-widget">
                            <h6 class="footer-title">DOWNLOAD OUR APP</h6>
                            <p class="footer-apps-dec">Fast &amp; Convenient Access</p>
                            <ul class="footer-apps-list">
                                <li><a href="#"><img src="assets/images/others/apple_store.png" alt=""></a></li>
                                <li><a href="#"><img src="assets/images/others/google_play.png" alt=""></a></li>
                            </ul>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="copy-right-content">
                    <p>Copyright © <a href="#">{{ shop.name }}</a>. Tous droits réservés.</p>
                  
                    <div class="payment-image">
                        <img src="/assets/images/others/payment.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
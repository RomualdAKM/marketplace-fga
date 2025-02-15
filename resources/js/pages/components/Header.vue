<script setup>
import { ref, reactive, onMounted } from "vue";
import { useCartStore } from '../../stores/cart';
import router from '../../router/index.js'
  
const cartStore = useCartStore();

const shop = ref('')
const user = ref({})


const getAuthUser = async () => {
    const response = await axios.get('/api/get_auth_user_info')
    user.value = response.data
    console.log('user',response.data)
}


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

const isUserNotConnected = () => {
  return  sessionStorage.getItem("token") !== null  || sessionStorage.getItem("token") != undefined;
};

const logout = () => {
    sessionStorage.removeItem("token");
    user.value = null;
    window.location.reload();
    router.push("/");
};


onMounted(async () => {
    await getShop();
    await getAuthUser();

});


</script>


<template>
    <header class="header" >
        <div class="desktop-header header1 d-none d-lg-block " >
            
            <div class="header-middle-area " >
                <div class="container fixed-top" style="background-color: #f4f4f4; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="logo">
                                <a href="/"><img :src="'/storage/'+shop.logo" alt="" style="max-width: 50px; border-radius: 50%; object-fit: cover; width: 50px; height: 50px; border: 2px solid white"></a>
                                <!-- <a href="/"><img :src="'/storage/'+shop.logo" alt="" style="max-width: 50px; border-radius: 50%"></a> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="main-menu-area">
                                <!--  Start Mainmenu Nav-->
                                <nav class="main-navigation">
                                    <ul>
                                        <li class="active"><a href="/">Accueil</a>
                                    
                                          
                                        </li>
                                        <li class="active"><a href="/#category">Categories</a>
                                          
                                        </li>
                                        <li class="active"><a href="/products">Produits</a>
                                          
                                        </li>
                                        <li class="active"><a href="/contact">Conatct</a>
                                          
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="header-middle-right-area">
                                <!-- <div class="my-account search-block-mobile search-sidebar">
                                    <button class="header-action-item mobile-search-popup"><i
                                            class="icon-rt-loupe"></i></button>
                                </div>
                                <div class="wishlist">
                                    <router-link to="/cart" class="header-action-item">
                                        <i class="icon-rt-heart2"></i>
                                        <span class="wishlist-count">2</span>
                                    </router-link>
                                </div> -->
                                <div class="wishlist">
                                    <router-link to="/my-account" class="header-action-item">
                                        <i class="icon-rt-user"></i>
                                  
                                    </router-link>
                                </div>
                                <div class="cart">
                                    <router-link to="/cart" class="header-action-item toolbar-btn">
                                        <i class="icon-rt-basket-outline"></i>
                                        <span class="wishlist-count">{{cartStore.items.length}}</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-top-area bg-secondary" v-if="shop" >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-4">
                            <div class="header-top-left-area">
                                <p class="header-top-text-message text-white"> <i class="icon-rt-call-outline"></i> Besoin

                                    d'aide ? Appelez-nous : <a :href="'tel:'+shop.phone">{{ shop.phone }}</a></p>
                               
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4" v-if="isUserNotConnected()">
                            <div class="header-top-left-area">
                                <p class="header-top-text-message text-white">Salut,

                                  <a href="#">{{user.name}}</a></p>
                               
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="header-top-right-area header-top-settings">
                                <router-link v-if="!isUserNotConnected()" :to="{ name: 'Auth' }" class="text-white" 
                                    >Se connecter</router-link>
                                    <button v-else @click="logout" class="bg-green-900 p-3 border rounded-lg text-gray-200 hover:text-white transition">
                                    Déconnexion
                                </button>
                                  
                                <!-- <ul class="nav align-items-center">
                                    <li class="language  text-white">English <i class="icon-rt-arrow-down"></i>
                                        <ul class="dropdown-list">
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">French</a></li>
                                        </ul>
                                    </li>
                                    <li class="curreny-wrap  text-white">Currency <i class="icon-rt-arrow-down"></i>
                                        <ul class="dropdown-list curreny-list">
                                            <li><a href="#">$ USD</a></li>
                                            <li><a href="#"> € EURO</a></li>
                                        </ul>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-header main-header m-header-1 d-block d-lg-none">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col mobile-header-start">
                        <div class="d-flex gap-2">
                            <div class="menu-mobile">
                                <a href="#moible-menu" class="m-menu-btn mobile-menu-active">
                                    <i class="icon-rt-bars-solid"></i>
                                </a>
                            </div>

                            <div class="m-menu-side" id="moible-menu">
                                <div class="mobile-menu-inner">
                                    <a href="#" class="side-close-icon"><i class="icon-rt-close-outline"></i></a>
                                    <!-- <ul class="mobile-lan-curr-nav align-items-center">
                                        <li class="language">English <i class="icon-rt-arrow-down"></i>
                                            <ul class="dropdown-list">
                                                <li><a href="#">English</a></li>
                                                <li><a href="#">French</a></li>
                                            </ul>
                                        </li>
                                        <li class="curreny-wrap">Currency <i class="icon-rt-arrow-down"></i>
                                            <ul class="dropdown-list curreny-list">
                                                <li><a href="#">$ USD</a></li>
                                                <li><a href="#"> € EURO</a></li>
                                            </ul>
                                        </li>
                                    </ul> -->
                                    <div class="mobile-top-text-message">
                                        <!-- <p class="text-message">Free shipping on orders over $25. Read more.</p> -->
                                        <p class="text-message"> <i class="icon-rt-call-outline"></i> Need help? Call
                                            Us: <a :href="'tel:'+shop.phone">{{ shop.phone }}</a></p>
                                    </div>
                                    <div class="mobile-tab-wrap">
                                        <div class="mobile-tab-menu">
                                            <ul class="nav" role="tablist">
                                                <li class="tab__item nav-item">
                                                    <a class="active" data-bs-toggle="tab" href="#menu_tab"
                                                        role="tab">Menu</a>
                                                </li>
                                                <li class="tab__item nav-item">
                                                    <a data-bs-toggle="tab" href="#category"
                                                        role="tab">Categories</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="menu_tab" role="tabpanel">
                                                <nav class="offcanvas-navigation">
                                                    <ul>
                                                        <li class="has-children">
                                                            <a href="/">Accueil</a>
                                                           
                                                        </li>
                                                        <li class="has-children">
                                                            <a href="/#category">Categories</a>
                                                           
                                                        </li>
                                                        <li class="has-children">
                                                            <a href="/products">Products</a>
                                                           
                                                        </li>
                                                        <li class="has-children">
                                                            <a href="/contact">Contact</a>
                                                           
                                                        </li>
                                                      

                                                    </ul>
                                                </nav>
                                            </div>
                                        

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mobile-header-mobile">
                        <div class="logo text-center">
                            <a href="#"><img :src="'/storage/'+shop.logo" alt=""></a>
                        </div>
                    </div>
                    <div class="col mobile-header-right">
                        <div class="header-middle-right-area">
                            <div class="my-account">
                                <a href="#" class="header-action-item" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="icon-rt-user"></i></a>
                            </div>
                            <div class="cart">
                                <router-link to="/cart" class="header-action-item toolbar-btn">
                                    <i class="icon-rt-basket-outline"></i>
                                    <span class="wishlist-count">{{cartStore.items.length}}</span>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </header>
</template>
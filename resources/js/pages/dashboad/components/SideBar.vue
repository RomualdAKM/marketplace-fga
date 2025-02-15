<script setup>
import {ref,onMounted} from 'vue'
import router from "./../../../router/index.js"

const user = ref({})
const shop = ref({})

const getAuthUser = async () => {
    const response = await axios.get('/api/get_auth_user_info')
    user.value = response.data
    console.log('user',response.data)
}

const getShopInfo = async () => {
    const response = await axios.get('/api/get_shop')
    shop.value = response.data
    console.log('shop',response.data)
}

const logout =  () => {
    sessionStorage.removeItem("token");
 
    router.push("/");
};

onMounted (async() => {
  await  getShopInfo()

  await  getAuthUser()
})

</script>

<template>         
                 <div class="side-menu__content h-full box bg-white/[0.95] rounded-none xl:rounded-xl z-20 relative w-[275px] duration-300 transition-[width] group-[.side-menu--collapsed]:xl:w-[91px] group-[.side-menu--collapsed.side-menu--on-hover]:xl:shadow-[6px_0_12px_-4px_#0000000f] group-[.side-menu--collapsed.side-menu--on-hover]:xl:w-[275px] overflow-hidden flex flex-col">
                    <div class="flex-none hidden xl:flex items-center z-10 px-5 h-[65px] w-[275px] overflow-hidden relative duration-300 group-[.side-menu--collapsed]:xl:w-[91px] group-[.side-menu--collapsed.side-menu--on-hover]:xl:w-[275px]">
                        <a class="flex items-center transition-[margin] duration-300 group-[.side-menu--collapsed.side-menu--on-hover]:xl:ml-0 group-[.side-menu--collapsed]:xl:ml-2" href="#">
                            <div class="flex h-[34px] w-[34px] items-center justify-center rounded-lg bg-gradient-to-b from-theme-1 to-theme-2/80 transition-transform ease-in-out group-[.side-menu--collapsed.side-menu--on-hover]:xl:-rotate-180">
                                <div class="relative h-[16px] w-[16px] -rotate-45 [&_div]:bg-white">
                                    <img v-if="shop.logo" :src="'/storage/'+ shop.logo" alt="logo">
                                    <img v-else src="/logo_company" alt="logo">
                                </div>
                            </div>
                            <div v-if="shop.name" class="ml-3.5 font-medium transition-opacity group-[.side-menu--collapsed.side-menu--on-hover]:xl:opacity-100 group-[.side-menu--collapsed]:xl:opacity-0">
                                {{shop.name}}
                            </div>
                            <div v-else class="ml-3.5 font-medium transition-opacity group-[.side-menu--collapsed.side-menu--on-hover]:xl:opacity-100 group-[.side-menu--collapsed]:xl:opacity-0">
                               E-COM
                            </div>
                        </a>
                        <a class="toggle-compact-menu ml-auto hidden h-[20px] w-[20px] items-center justify-center rounded-full border border-slate-600/40 transition-[opacity,transform] hover:bg-slate-600/5 group-[.side-menu--collapsed]:xl:rotate-180 group-[.side-menu--collapsed.side-menu--on-hover]:xl:opacity-100 group-[.side-menu--collapsed]:xl:opacity-0 3xl:flex" href="#">
                            <i data-tw-merge="" data-lucide="arrow-left" class="h-3.5 w-3.5 stroke-[1.3]"></i>
                        </a>
                    </div>
                    <div class="scrollable-ref w-full h-full z-20 px-5 overflow-y-auto overflow-x-hidden pb-3 [-webkit-mask-image:-webkit-linear-gradient(top,rgba(0,0,0,0),black_30px)] [&:-webkit-scrollbar]:w-0 [&:-webkit-scrollbar]:bg-transparent [&_.simplebar-content]:p-0 [&_.simplebar-track.simplebar-vertical]:w-[10px] [&_.simplebar-track.simplebar-vertical]:mr-0.5 [&_.simplebar-track.simplebar-vertical_.simplebar-scrollbar]:before:bg-slate-400/30">
                        <ul class="scrollable">
                            <!-- BEGIN: First Child -->
                            <li class="side-menu__divider">
                                DASHBOARDS
                            </li>
                            <li>
                                <a to="/dashboad/statistic" class="side-menu__link side-menu__link--active ">
                                    <i data-tw-merge="" data-lucide="gauge-circle" class="stroke-[1] w-5 h-5 side-menu__link__icon"></i>
                                    <div class="side-menu__link__title">Statistiques</div>
                                 
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>

                            <li class="side-menu__divider">
                                REGLAGES GÉNÉRAUX
                            
                            </li>

                            <li>
                                <a href="/dashboad/setting" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="briefcase" class="lucide lucide-briefcase stroke-[1] w-5 h-5 side-menu__link__icon"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                    <div class="side-menu__link__title">Informations du profil</div>
                                  
                                </a>
                                <!-- END: Second Child -->
                            </li>
                            <li>
                                <a href="/dashboad/configshop" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="radar" class="lucide lucide-radar stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M19.07 4.93A10 10 0 0 0 6.99 3.34"></path><path d="M4 6h.01"></path><path d="M2.29 9.62A10 10 0 1 0 21.31 8.35"></path><path d="M16.24 7.76A6 6 0 1 0 8.23 16.67"></path><path d="M12 18h.01"></path><path d="M17.99 11.66A6 6 0 0 1 15.77 16.67"></path><circle cx="12" cy="12" r="2"></circle><path d="m13.41 10.59 5.66-5.66"></path></svg>
                                    <div class="side-menu__link__title">Configuration du site</div>
                                   
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>
                            <li>
                                <a href="/dashboad/confidentialityshop" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="radar" class="lucide lucide-radar stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M19.07 4.93A10 10 0 0 0 6.99 3.34"></path><path d="M4 6h.01"></path><path d="M2.29 9.62A10 10 0 1 0 21.31 8.35"></path><path d="M16.24 7.76A6 6 0 1 0 8.23 16.67"></path><path d="M12 18h.01"></path><path d="M17.99 11.66A6 6 0 0 1 15.77 16.67"></path><circle cx="12" cy="12" r="2"></circle><path d="m13.41 10.59 5.66-5.66"></path></svg>
                                    <div class="side-menu__link__title">Politique de confidentialité</div>
                                   
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>
                            <li>
                                <a href="/dashboad/conditionshop" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="radar" class="lucide lucide-radar stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M19.07 4.93A10 10 0 0 0 6.99 3.34"></path><path d="M4 6h.01"></path><path d="M2.29 9.62A10 10 0 1 0 21.31 8.35"></path><path d="M16.24 7.76A6 6 0 1 0 8.23 16.67"></path><path d="M12 18h.01"></path><path d="M17.99 11.66A6 6 0 0 1 15.77 16.67"></path><circle cx="12" cy="12" r="2"></circle><path d="m13.41 10.59 5.66-5.66"></path></svg>
                                    <div class="side-menu__link__title">Condition de vente générale </div>
                                   
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>
                            <li>
                                <a href="/dashboad/banners" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="radar" class="lucide lucide-radar stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M19.07 4.93A10 10 0 0 0 6.99 3.34"></path><path d="M4 6h.01"></path><path d="M2.29 9.62A10 10 0 1 0 21.31 8.35"></path><path d="M16.24 7.76A6 6 0 1 0 8.23 16.67"></path><path d="M12 18h.01"></path><path d="M17.99 11.66A6 6 0 0 1 15.77 16.67"></path><circle cx="12" cy="12" r="2"></circle><path d="m13.41 10.59 5.66-5.66"></path></svg>
                                    <div class="side-menu__link__title">Bannière du site</div>
                                   
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>
                           
                            <li class="side-menu__divider">
                               LIVRAISON
                            </li>
                            <li>
                                <a href="/dashboad/countries" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="book-marked" class="lucide lucide-book-marked stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path><polyline points="10 2 10 10 13 7 16 10 16 2"></polyline></svg>
                                    <div class="side-menu__link__title">Pays</div>
                                </a>
                              
                            </li>
                            <li>
                                <a href="/dashboad/cities" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="book-marked" class="lucide lucide-book-marked stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path><polyline points="10 2 10 10 13 7 16 10 16 2"></polyline></svg>
                                    <div class="side-menu__link__title">Villes</div>
                                </a>
                              
                            </li>



                            <li class="side-menu__divider">
                                E-COMMERCE
                            </li>
                            <li>
                                <a href="/dashboad/categories" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="book-marked" class="lucide lucide-book-marked stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path><polyline points="10 2 10 10 13 7 16 10 16 2"></polyline></svg>
                                    <div class="side-menu__link__title">Categories</div>
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>
                            <li>
                                <a href="/dashboad/addproduct" class="side-menu__link ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="compass" class="lucide lucide-compass stroke-[1] w-5 h-5 side-menu__link__icon"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                    <div class="side-menu__link__title">Ajouter un produit</div>
                                    
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>
                            <li>
                                <a href="/dashboad/products" class="side-menu__link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="table2" class="lucide lucide-table2 stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18"></path></svg>
                                    <div class="side-menu__link__title">Produits</div>
                                </a>
                               
                            </li>
                            <li>
                                <a href="/dashboad/codes" class="side-menu__link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="album" class="lucide lucide-album stroke-[1] w-5 h-5 side-menu__link__icon"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect><polyline points="11 3 11 11 14 8 17 11 17 3"></polyline></svg>
                                    <div class="side-menu__link__title">Code Promo</div>
                                </a>
                               
                            </li>
                       
                            <li>
                                <a href="/dashboad/orders" class="side-menu__link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="sigma-square" class="lucide lucide-sigma-square stroke-[1] w-5 h-5 side-menu__link__icon"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M16 8.9V7H8l4 5-4 5h8v-1.9"></path></svg>
                                    <div class="side-menu__link__title">Commandes</div>
                                  
                                </a>
                               
                            </li>

                    
                            <li>
                                <a href="/dashboad/reviews" class="side-menu__link side-menu__link--active ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="goal" class="lucide lucide-goal stroke-[1] w-5 h-5 side-menu__link__icon"><path d="M12 13V2l8 4-8 4"></path><path d="M20.55 10.23A9 9 0 1 1 8 4.94"></path><path d="M8 10a5 5 0 1 0 8.9 2.02"></path></svg>
                                    <div class="side-menu__link__title">Avis</div>
                                   
                                </a>
                                <!-- BEGIN: Second Child -->
                                <!-- END: Second Child -->
                            </li>
                          
                        </ul>
                    </div>
                </div>
          
</template>
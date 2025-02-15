<template>
    <div
        class="echo group bg-gradient-to-b from-slate-200/70 to-slate-50 background relative min-h-screen before:content-[''] before:h-[370px] before:w-screen before:bg-gradient-to-t before:from-theme-1/80 before:to-theme-2 [&.background--hidden]:before:opacity-0 before:transition-[opacity,height] before:ease-in-out before:duration-300 before:top-0 before:fixed after:content-[''] after:h-[370px] after:w-screen [&.background--hidden]:after:opacity-0 after:transition-[opacity,height] after:ease-in-out after:duration-300 after:top-0 after:fixed after:bg-texture-white after:bg-contain after:bg-fixed after:bg-[center_-13rem] after:bg-no-repeat">
        <div
            class="[&.loading-page--before-hide]:h-screen [&.loading-page--before-hide]:relative loading-page loading-page--before-hide [&.loading-page--before-hide]:before:block [&.loading-page--hide]:before:opacity-0 before:content-[''] before:transition-opacity before:duration-300 before:hidden before:inset-0 before:h-screen before:w-screen before:fixed before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:z-[60] [&.loading-page--before-hide]:after:block [&.loading-page--hide]:after:opacity-0 after:content-[''] after:transition-opacity after:duration-300 after:hidden after:h-16 after:w-16 after:animate-pulse after:fixed after:opacity-50 after:inset-0 after:m-auto after:bg-loading-puff after:bg-cover after:z-[61]">
            <SideMenu />

            <div
                class="content transition-[margin,width] duration-100 xl:pl-3.5 pt-[54px] pb-16 relative z-10 group mode content--compact xl:ml-[275px] mode--light [&.content--compact]:xl:ml-[91px]">

                <div class="mt-16 px-5">
                    <div class="container">

                        <div class="grid grid-cols-12 gap-x-6 gap-y-10">
                            <div class="col-span-12">
                                <div class="flex flex-col gap-y-3 md:h-10 md:flex-row md:items-center">
                                    <div class="text-base font-medium group-[.mode--light]:text-white">
                                       show order
                                    </div>
                                   
                                </div>
                                <div class="mt-3.5">
                                    <div class="box box--stacked flex flex-col">
                                        <div class="flex flex-col gap-y-2 p-5 sm:flex-row sm:items-center">
                                            <div>
                                                <div class="relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="search" class="lucide lucide-search absolute inset-y-0 left-0 z-10 my-auto ml-3 h-4 w-4 stroke-[1.3] text-slate-500"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                                                    <input type="text" placeholder="Search orders..." class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 rounded-[0.5rem] pl-9 sm:w-64">
                                                </div>
                                            </div>
                                     
                                        </div>
                                        <div class="overflow-auto xl:overflow-visible">
                                            <table class="w-full text-left border-b border-slate-200/60" v-if="order && order.items && order.items.length">
                                                <thead class="">
                                                    <tr class="">
                                                       
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                                            Images
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                                            Product 
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                                            Unit Price
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                                            Options
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                                            Quantity
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                                            Detail de livraison
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                                            Total
                                                        </td>
                                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="[&amp;_td]:last:border-b-0" v-for="item in order.items" :key="item.id">
                                                       
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                            <div class="flex">
                                                                <div class="image-fit zoom-in h-9 w-9">
                                                                    <img data-placement="top" :src="'/storage/' + getImageUrl(item.product.productimages)" alt="Tailwise - Admin Dashboard Template" class="tooltip cursor-pointer rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]">
                                                                </div>
                                                               
                                                            </div>
                                                        </td>
                                                      
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap">
                                                                {{ item.product.name }}
                                                            </div>
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap">
                                                                {{ formatPrice(item.price) }}
                                                            </div>
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap" v-for="option in item.options" :key="option.id">
                                                                <span>|| {{ option.variation_option.name }} || </span>
                                                            </div>
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap">
                                                                {{ item.quantity }}
                                                            </div>
                                                        </td>
                                                        <td v-if="order.delivery_detail" class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap">
                                                                <ul class="flex flex-col gap-2">
                                                                    <li class="flex items-center gap-2">
                                                                        <span class="w-1/4">Nom complet:</span>
                                                                        <span>{{order.delivery_detail.full_name}}</span>
                                                                    </li>
                                                                    <li class="flex items-center gap-2">
                                                                        <span class="w-1/4">Email:</span>
                                                                        <span>{{order.delivery_detail.email}}</span>
                                                                    </li>
                                                                    <li class="flex items-center gap-2">
                                                                        <span class="w-1/4">Numero:</span>
                                                                        <span>{{order.delivery_detail.phone}}</span>
                                                                    </li>
                                                                    <li class="flex items-center gap-2">
                                                                        <span class="w-1/4">Ville:</span>
                                                                        <span>{{order.delivery_detail.delivery_city.city_name}}</span>
                                                                    </li>
                                                                    <li class="flex items-center gap-2">
                                                                        <span class="w-1/4">Pays:</span>
                                                                        <span>{{order.delivery_detail.delivery_country.country_name}}</span>
                                                                    </li>
                                                                    <li class="flex items-center gap-2">
                                                                        <span class="w-1/4">Adresse:</span>
                                                                        <span>{{order.delivery_detail.address}}</span>
                                                                    </li>
                                                                </ul>
                                                              
                                                            </div>
                                                        </td>
                                                        <td class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap">
                                                                {{ formatPrice(item.price * item.quantity) }}
                                                            </div>
                                                        </td>
                                                      
                                                    
                                                    </tr>
                                                  
                                                </tbody>
                                            </table>
                                        </div>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import SideMenu from "../components/SideMenu.vue"
import { useRoute } from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const route = useRoute();
const orderId = ref(route.params.orderId);
const order = ref(null);

const getOrderItems = async () => {
    try {
        const response = await axios.get(`/api/get_order/${orderId.value}`);
        if (response.data.length > 0) {
            order.value = response.data[0];
        }
        console.log('order', response.data);
        console.log('order.value', order.value);
    } catch (error) {
        console.error('Error fetching order:', error);
    }
};

const formatPrice = (price) => {
    return `$${parseFloat(price).toFixed(2)}`;
};

const getImageUrl = (productImages) => {
    return productImages.length ? productImages[0].image_url : '/storage/';
};

const loading = ref(true)

onMounted(async () => {

    loading.value = true;

if (!sessionStorage.getItem('page033Reloaded')) {
    // Marquer que la page a été rechargée pour cette visite
    sessionStorage.setItem('page033Reloaded', true);
    
    // Recharger la page une seule fois
    window.location.reload();
   
} else {
    // Réinitialiser le marquage pour la prochaine visite
    sessionStorage.removeItem('page033Reloaded');
    loading.value = false;
   
}

console.log('loading', loading.value)
    await getOrderItems();

});

</script>
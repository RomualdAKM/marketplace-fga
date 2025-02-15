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
       <div class="fixed inset-x-0 top-0 mt-3.5 h-[65px] transition-[margin] duration-100 xl:ml-[275px] group-[.side-menu--collapsed]:xl:ml-[90px]">
                    <div class="top-bar absolute left-0 xl:left-3.5 right-0 h-full mx-5 group before:content-[''] before:absolute before:top-0 before:inset-x-0 before:-mt-[15px] before:h-[20px] before:backdrop-blur">
                        <div class="box group-[.top-bar--active]:box container flex h-full w-full items-center border-transparent bg-transparent shadow-none transition-[padding,background-color,border-color] duration-300 ease-in-out group-[.top-bar--active]:border-transparent group-[.top-bar--active]:bg-transparent group-[.top-bar--active]:bg-gradient-to-r group-[.top-bar--active]:from-theme-1 group-[.top-bar--active]:to-theme-2 group-[.top-bar--active]:px-5">
                            <div class="flex items-center gap-1 xl:hidden">
                                <a class="open-mobile-menu rounded-full p-2 text-white hover:bg-white/5" href="#">
                                    <i data-tw-merge="" data-lucide="align-justify" class="stroke-[1] h-[18px] w-[18px]"></i>
                                </a>
                                <a class="rounded-full p-2 text-white hover:bg-white/5" data-tw-toggle="modal" data-tw-target="#quick-search" href="javascript:;">
                                    <i data-tw-merge="" data-lucide="search" class="stroke-[1] h-[18px] w-[18px]"></i>
                                </a>
                            </div>
                            <!-- BEGIN: Breadcrumb -->
                            <nav aria-label="breadcrumb" class="flex hidden flex-1 xl:block">
                                <ol class="flex items-center text-theme-1 dark:text-slate-300 text-white/90">
                                    <li class="">
                                        <a href="/">Page d'accueil</a>
                                    </li>
                                    <!-- <li class="relative ml-5 pl-0.5 before:content-[''] before:w-[14px] before:h-[14px] before:bg-chevron-white before:transform before:rotate-[-90deg] before:bg-[length:100%] before:-ml-[1.125rem] before:absolute before:my-auto before:inset-y-0 dark:before:bg-chevron-white">
                                        <a href="#">Dashboards</a>
                                    </li> -->
                                    <!-- <li class="relative ml-5 pl-0.5 before:content-[''] before:w-[14px] before:h-[14px] before:bg-chevron-white before:transform before:rotate-[-90deg] before:bg-[length:100%] before:-ml-[1.125rem] before:absolute before:my-auto before:inset-y-0 dark:before:bg-chevron-white text-white/70">
                                        <a href="#">Analytics</a>
                                    </li> -->
                                </ol>
                            </nav>
                            <!-- END: Breadcrumb -->
                            <!-- BEGIN: Search -->
                            <!-- <div class="relative hidden flex-1 justify-center xl:flex" data-tw-toggle="modal" data-tw-target="#quick-search">
                                <div class="flex w-[350px] cursor-pointer items-center rounded-[0.5rem] border border-transparent bg-white/[0.12] px-3.5 py-2 text-white/60 transition-colors duration-300 hover:bg-white/[0.15] hover:duration-100">
                                    <i data-tw-merge="" data-lucide="search" class="stroke-[1] h-[18px] w-[18px]"></i>
                                    <div class="ml-2.5 mr-auto">Quick search...</div>
                                    <div>⌘K</div>
                                </div>
                            </div> -->
                            <div id="quick-search" aria-hidden="true" tabindex="-1" class="modal group bg-gradient-to-b from-theme-1/50 via-theme-2/50 to-black/50 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 overflow-y-hidden z-[60] [&:not(.show)]:duration-[0s,0.2s] [&:not(.show)]:delay-[0.2s,0s] [&:not(.show)]:invisible [&:not(.show)]:opacity-0 [&.show]:visible [&.show]:opacity-100 [&.show]:duration-[0s,0.1s]">
                                <div class="relative mx-auto my-2 w-[95%] scale-95 transition-transform group-[.show]:scale-100 sm:mt-40 sm:w-[600px] lg:w-[700px]">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex w-12 items-center justify-center">
                                            <i data-tw-merge="" data-lucide="search" class="stroke-[1] w-5 h-5 -mr-1.5 text-slate-500"></i>
                                        </div>
                                        <input data-tw-merge="" type="text" placeholder="Quick search..." class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full border-slate-200 placeholder:text-slate-400/90 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 rounded-lg border-0 py-3.5 pl-12 pr-14 text-base shadow-lg focus:ring-0">
                                        <div class="absolute inset-y-0 right-0 flex w-14 items-center">
                                            <div class="mr-auto rounded-[0.4rem] border bg-slate-100 px-2 py-1 text-xs text-slate-500/80">
                                                ESC
                                            </div>
                                        </div>
                                    </div>
                                  -->
                                </div>
                            </div>
                            <!-- END: Search -->
                            <!-- BEGIN: Notification & User Menu -->
                            <div class="flex flex-1 items-center">
                                <div class="ml-auto flex items-center gap-1">
                                    <!-- <a class="rounded-full p-2 text-white hover:bg-white/5" data-tw-toggle="modal" data-tw-target="#activities-panel" href="javascript:;">
                                        <i data-tw-merge="" data-lucide="layout-grid" class="stroke-[1] h-[18px] w-[18px]"></i>
                                    </a>
                                    <a class="request-full-screen rounded-full p-2 text-white hover:bg-white/5" href="#">
                                        <i data-tw-merge="" data-lucide="expand" class="stroke-[1] h-[18px] w-[18px]"></i>
                                    </a> -->
                                    <!-- <a class="rounded-full p-2 text-white hover:bg-white/5" data-tw-toggle="modal" data-tw-target="#notifications-panel" href="javascript:;">
                                        <i data-tw-merge="" data-lucide="bell" class="stroke-[1] h-[18px] w-[18px]"></i>
                                    </a> -->
                                </div>
                                <div data-tw-merge="" data-tw-placement="bottom-end"
                                 class="dropdown relative ml-5"><button data-tw-toggle="dropdown"
                                  aria-expanded="false" class="cursor-pointer image-fit h-[36px] w-[36px] overflow-hidden rounded-full border-[3px] border-white/[0.15]">
                                  <img v-if="shop.logo" :src="'/storage/'+ shop.logo" alt="logo">
                                  <img v-else src="/logo_company" alt="logo">
                                    </button>
                                    <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                                        <div data-tw-merge="" class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 mt-1 w-56">

                                            <a href="/dashboad/setting" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i data-tw-merge="" data-lucide="lock" class="stroke-[1] mr-2 h-4 w-4"></i>
                                              Modifier mot de passe
                                            </a> 
                                            <a @click="logout()" class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i data-tw-merge="" data-lucide="power" class="stroke-[1] mr-2 h-4 w-4"></i>
                                                Deconnexion
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                            <!-- END: Notification & User Menu -->
                        </div>
                    </div>
        </div>
</template>
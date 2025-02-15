<script setup>
import SideMenu from "./components/SideMenu.vue"
import {ref,onMounted} from 'vue'

const loading = ref(true)

// On component mount
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
  await getCategories()
  await fetchProduct()
})

</script>

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
                        <div class="col-span-12 flex flex-col gap-y-7 xl:col-span-9">
                            <div class="box box--stacked flex flex-col p-1.5">
                                <div
                                    class="relative h-60 w-full rounded-[0.6rem] bg-gradient-to-b from-theme-1/95 to-theme-2/95">
                                    <div
                                        class="w-full h-full relative overflow-hidden before:content-[''] before:absolute before:inset-0 before:bg-texture-white before:-mt-[50rem] after:content-[''] after:absolute after:inset-0 after:bg-texture-white after:-mt-[50rem]">
                                    </div>
                                 
                                </div>
                               
                            </div>
                            <div class="box box--stacked flex flex-col p-5">
                                <div
                                    class="mb-6 border-b border-dashed border-slate-300/70 pb-5 text-[0.94rem] font-medium">
                                    En cours ....
                                </div>
                               
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
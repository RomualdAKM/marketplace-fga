<script setup>
import CloseMobileMenu from "./CloseMobileMenu.vue"
import SideBar from "./SideBar.vue"
import TopBar from "./TopBar.vue"

</script>

<template>
       
          <div class="side-menu xl:ml-0 shadow-xl transition-[margin,padding] duration-300 xl:shadow-none fixed top-0 left-0 z-50 group inset-y-0 xl:py-3.5 xl:pl-3.5 after:content-[''] after:fixed after:inset-0 after:bg-black/80 after:xl:hidden side-menu--collapsed [&.side-menu--mobile-menu-open]:ml-0 [&.side-menu--mobile-menu-open]:after:block -ml-[275px] after:hidden">
               <CloseMobileMenu />
               <SideBar />
               <TopBar />
            </div>
  
</template>
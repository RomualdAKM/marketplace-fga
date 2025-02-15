<template>
    <Header />
      <main>
        <Banner />
        <Categories />
        <Products />
        <Footer />

      </main>
</template>

<script setup>
import { ref } from 'vue'
import Header from "../components/Header.vue"
import Banner from "../components/Banner.vue"
import Categories from "../components/Categories.vue"
import Products from "../components/Products.vue"
import Footer from "../components/Footer.vue"

</script>
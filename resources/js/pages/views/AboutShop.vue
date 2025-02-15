<script setup>
import { ref, onMounted } from 'vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';


const shop = ref({})
const getshop = async () => {
    await axios
        .get("/api/get_shop")
        .then((res) => {
            if (res.data) {

                shop.value = res.data;
            }

            console.log("shop", form.value);
        })
        .catch((err) => {
            console.log(err);
        });
};

onMounted(async () => {
    await getshop();
});
</script>

<template>
    
    <Header />
    <main>
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="page-title">A propos de nous</h1>
                            <ul class="breadcrumb-page-list">
                                <li class="breadcrumb-item"><router-link to="/">Accueil</router-link></li>
                                <li class="breadcrumb-item">A propos de nous</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-secton-wrapper section-space-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 mx-auto">
                        <div class="title text-center">
                            <h2 class="fw-bold mb-3"><span class="text-primary">{{ shop.name }}</span></h2>
                            <p class="text" v-html="shop.description"></p>
                        </div>
                    </div>
                  
                </div>
            </div>
        </section>


    <Footer class="mt-5"/>
        
    </main>
</template>
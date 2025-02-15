<script setup>
import { ref, onMounted } from 'vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';


const condition = ref({})
const getCondition = async () => {
    await axios
        .get("/api/get_condition")
        .then((res) => {
            if (res.data) {

                condition.value = res.data;
            }

            console.log("shop", form.value);
        })
        .catch((err) => {
            console.log(err);
        });
};

onMounted(async () => {
    await getCondition();
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
                            <h1 class="page-title">Condition de vente générale</h1>
                            <ul class="breadcrumb-page-list">
                                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                <li class="breadcrumb-item">Condition de vente générale</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-secton-wrapper section-space-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="privacy-policy-content">
                           
                            <h2 class="fw-bold mb-2">{{ condition.title }}</h2>
                            <div v-html="condition.description"></div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </section>


    <Footer class="mt-5"/>
        
    </main>
</template>
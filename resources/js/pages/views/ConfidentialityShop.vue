<script setup>
import { ref, onMounted } from 'vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';


const confidentiality = ref({})
const getConfidentiality = async () => {
    await axios
        .get("/api/get_confidentiality")
        .then((res) => {
            if (res.data) {

                confidentiality.value = res.data;
            }

            console.log("shop", form.value);
        })
        .catch((err) => {
            console.log(err);
        });
};

onMounted(async () => {
    await getConfidentiality();
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
                            <h1 class="page-title">Politique de confidentialité</h1>
                            <ul class="breadcrumb-page-list">
                                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                <li class="breadcrumb-item">Politique de confidentialité</li>
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
                           
                            <h2 class="fw-bold mb-2">{{ confidentiality.title }}</h2>
                            <div v-html="confidentiality.description"></div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </section>


    <Footer class="mt-5"/>
        
    </main>
</template>
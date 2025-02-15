<template>
    <div class="col-md-12 col-lg-2">
                                    <!-- Nav tabs -->
                                    <ul role="tablist" class="nav flex-column dashboard-list">
                                        <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">Dashboard</a></li>
                                        <li> <a href="#orders" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">Commandes</a></li>
                                        <!-- <li><a href="#downloads" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">Downloads</a></li>
                                        <li><a href="#address" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">Addresses</a></li> -->
                                        <li><a href="#account-details" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">Paramètres</a></li>
                                        <li><a href="#" @click="logout" class="nav-link" aria-selected="false" tabindex="-1" role="tab">Déconnexion</a></li>
                                    </ul>
                                </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import router from '../../router/index.js'


const logout = () => {
    sessionStorage.removeItem("token");
    // authUser.value = null; 
    router.push("/");
};


</script>
<template>
     <div class="dashboard-upper-info">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-lg-3 col-md-12">
                                        <div class="d-single-info">
                                            <p class="user-name">Salut <span>{{ user.name }}</span></p>
                                            <!-- <p>(not yourmail@info? <a href="#">Log Out</a>)</p> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="d-single-info">
                                            <p>Besoin d'aide? Service client au.</p>
                                           
                                            <p>{{ shop.phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="d-single-info">
                                            <p>Envoyez-nous un e-mail à </p>
                                          
                                            <p>{{ shop.email }}</p>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

const user = ref({})
const shop = ref({})

const getAuthUserInfo = async () => {
    const response = await axios.get('/api/get_auth_user_info');
    user.value = response.data;
    console.log('user', response.data);
};
const getShopInfo = async () => {
    const response = await axios.get('/api/get_shop');
    shop.value = response.data;
    console.log('shop', response.data);
};

onMounted(async () => {
    await getShopInfo();
    await getAuthUserInfo();
});

</script>
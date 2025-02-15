<template>
    <div class="tab-pane fade active show" id="orders" role="tabpanel">
        <h3>Commandes</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Commande</th>
                       
                        <th>Date</th>
                        <th>Statut</th>
                      
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in orders" :key="item.id">
                        <td># {{ item.id }}</td>
                        <td>{{ formatDate(item.created_at)  }}</td>
                        <td>{{ item.status }}</td>
                        <td>${{ item.total_price }} </td>
                        <td><router-link :to="{ name: 'ViewOrder', params: { orderId: item.id } }"
                                class="view btn btn--primary">view</router-link></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

const orders = ref({})

const getOrdersAuthUser = async () => {
    const response = await axios.get('/api/get_orders_auth_user');
    orders.value = response.data;
    console.log('orders', response.data);
};


onMounted(async () => {
    await getOrdersAuthUser();
});

</script>
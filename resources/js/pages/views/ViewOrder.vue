<template>
    <Header />
    <main>
        <section class="page-section-wrapper section-space-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wishlist-title">
                            <h2 class="mb-5 fw-bold">View order</h2>
                        </div>
                        <form action="#" class="cart-table" v-if="order && order.items && order.items.length">
                            <div class="table-content table-responsive">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th class="plantmore-product-thumbnail">Images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="plantmore-product-price">Unit Price</th>
                                            <th class="plantmore-product-options">Options</th>
                                            <th class="plantmore-product-quantity">Quantity</th>
                                            <th class="plantmore-product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in order.items" :key="item.id">
                                            <td class="plantmore-product-thumbnail">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <img class="img-fluid" style="max-width: 100px;"
                                                        :src="'/storage/' + getImageUrl(item.product.productimages)"
                                                        alt="">
                                                </div>

                                            </td>
                                            <td class="cart-product-name">
                                                <a href="#">{{ item.product.name }}</a>
                                            </td>
                                            <td class="plantmore-product-price">
                                                <span class="amount">{{ formatPrice(item.price) }} {{shop.devise}}</span>
                                            </td>
                                            <td class="plantmore-product-options">
                                                <div v-for="option in item.options" :key="option.id">
                                                    <span>|| {{ option.variation_option.name }} || </span>
                                                </div>
                                            </td>
                                            <td class="plantmore-product-quantity">
                                                <div class="quantity">
                                                    <input class="cart-plus-minus-box" :value="item.quantity"
                                                        type="text" readonly>
                                                </div>
                                            </td>
                                            <td class="plantmore-product-subtotal">
                                                <span class="amount">{{ formatPrice(item.price * item.quantity)
                                                    }} {{shop.devise}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ml-auto">
                                    <div class="cart-page-total mt-4">
                                        <h2 class="fw-bold mb-3">Total</h2>
                                        <ul>
                                            <li>Total <span>{{ formatPrice(order.total_price) }} {{shop.devise}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div v-else>
                            <p>No order items found.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import Header from '../components/Header.vue';
import { useRoute } from 'vue-router';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const route = useRoute();
const orderId = ref(route.params.orderId);
const order = ref(null);

const getOrderItems = async () => {
    try {
        const response = await axios.get(`/api/get_order/${orderId.value}`);
        if (response.data.length > 0) {
            order.value = response.data[0];
        }
        console.log('order', response.data);
        console.log('order.value', order.value);
    } catch (error) {
        console.error('Error fetching order:', error);
    }
};

const formatPrice = (price) => {
    return `$${parseFloat(price).toFixed(2)}`;
};

const getImageUrl = (productImages) => {
    return productImages.length ? productImages[0].image_url : '/storage/';
};

const shop = ref('')
const getShop = async () => {
    await axios
        .get("/api/get_shop")
        .then((res) => {
            if (res.data) {

                shop.value = res.data;
            }

            console.log("shop", shop.value);
        })
        .catch((err) => {
            console.log(err);
        });
};

onMounted(async () => {
    await getShop();
    await getOrderItems();
});
</script>
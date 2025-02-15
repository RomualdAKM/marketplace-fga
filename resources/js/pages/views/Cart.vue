<script setup>
import { ref, onMounted, computed } from 'vue';
import Header from '../components/Header.vue';
import { useCartStore } from '../../stores/cart';
import router from '../../router';
import axios from 'axios';
import Footer from '../components/Footer.vue';

const cartStore = useCartStore();
let codes = ref({});
const formCode = ref('');
const cartTotal = computed(() => cartStore.getTotalPrice());

const getOptionsTotal = (options) => options.reduce((total, option) => total + option.additional_price, 0);

const getItemTotal = (item) => {
  const optionsTotal = getOptionsTotal(item.selectedOptions);
  return (item.product.base_price + optionsTotal) * item.quantity;
};

const removeItem = (product, selectedOptions) => {
  cartStore.removeFromCart(product, selectedOptions);
};

const increaseItemQuantity = (product, selectedOptions) => {
  const item = cartStore.items.find(i => i.product.id === product.id && JSON.stringify(i.selectedOptions) === JSON.stringify(selectedOptions));
  if (item.quantity >= item.product.stock) {
    toast.fire({
      icon: "error",
      title: "La quantité sélectionnée dépasse le stock disponible (" + item.product.stock + ")",
    });
    return;
  }
  cartStore.increaseQuantity(product, selectedOptions);
};

const decreaseItemQuantity = (product, selectedOptions) => {
  cartStore.decreaseQuantity(product, selectedOptions);
};

const getImageUrl = (productImages) => productImages.length ? productImages[0].image_url : '/storage/';

const fetchPromoCodes = async () => {
  try {
    const response = await axios.get('/api/get_codes');
    codes.value = response.data;
    console.log('codes', response.data);
  } catch (error) {
    console.error("Erreur lors de la récupération des codes promo", error);
  }
};

const applyPromo = () => {

  if (localStorage.getItem('appliedPromoCode')) {
    formCode.value = '';
    toast.fire({ icon: 'error', title: 'Code déja appliqué' });
  } else {
    const promo = codes.value.find(c => c.code === formCode.value);
    if (promo) {
      cartStore.applyPromo(promo);
      toast.fire({ icon: 'success', title: 'Code promo valide' });
      formCode.value = '';
    } else {
      formCode.value = '';
      toast.fire({ icon: 'error', title: 'Code promo invalide' });
    }
    
  }
};

const placeOrder = async () => {
  try {
    for (const item of cartStore.items) {
      if (item.quantity > item.product.stock) {
        alert(`La quantité du produit "${item.product.name}" dépasse le stock disponible.`);
        return;
      }
    }
    router.push('/checkout');
  } catch (error) {
    console.error('Error placing order:', error);
    toast.fire({
      icon: "error",
      title: "Une erreur s'est produite lors de la sauvegarde de la commande. Veuillez réessayer plus tard.",
    });
  }
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
  await fetchPromoCodes();
  await getShop();
  const appliedPromoCode = localStorage.getItem('appliedPromoCode');
  if (appliedPromoCode) {
    const promo = codes.value.find(c => c.code === appliedPromoCode);
    if (promo) {
      cartStore.applyPromo(promo);
    }
  }
});

</script>

<template>
  <Header />
  <main>
    <section class="page-section-wrapper section-space-ptb">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="wishlist-title">
              <h2 class="mb-5 fw-bold">Mon panier</h2>
          
            </div>
            <form @submit.prevent="placeOrder" class="cart-table">
              <div class="table-content table-responsive">
                <table class="table border">
                  <thead>
                    <tr>
                      <th class="plantmore-product-remove">Supprimer</th>
                   
                      <th class="plantmore-product-thumbnail">Images</th>
                      <th class="cart-product-name">Produit</th>
                      <th class="cart-product-name">Prix de base</th>
                    
                      <th class="plantmore-product-options">Options</th>
                      <th class="plantmore-product-price">Prix unitaire</th>
                      <th class="plantmore-product-quantity">Quantité</th>

                      <th class="plantmore-product-subtotal">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in cartStore.items" :key="item.product.id + JSON.stringify(item.selectedOptions)">
                      <td class="plantmore-product-remove">
                        <a href="#" @click.prevent="removeItem(item.product, item.selectedOptions)"><i class="icon-rt-close-outline"></i></a>
                      </td>
                      <td class="plantmore-product-thumbnail">
                        <a href="#"><img :src="'/storage/' + getImageUrl(item.product.productimages)" alt="" class="img-fluid" style="max-width: 100px;"></a>
                      </td>
                      <td class="plantmore-product-name"><a href="#">{{ item.product.name }}</a></td>
                      <td class="plantmore-product-name"><a href="#">{{ item.product.base_price }}  <span v-if="shop.devise">{{shop.devise}}</span></a></td>
                      <td class="plantmore-product-options">
                        <ul>
                          <li v-for="(option, index) in item.selectedOptions" :key="index">
                            {{ option.name }}: +{{ option.additional_price }} <span v-if="shop.devise">{{shop.devise}}</span>
                          </li>
                        </ul>
                      </td>
                      <td class="plantmore-product-price">
                        <span class="amount">{{ (item.product.base_price + getOptionsTotal(item.selectedOptions)) }} <span v-if="shop.devise">{{shop.devise}}</span></span>
                      </td>
                      <td class="plantmore-product-quantity">
                        <div class="quantity">
                          <div class="cart-plus-minus justify-content-center">
                            <div class="dec qtybutton" @click="decreaseItemQuantity(item.product, item.selectedOptions)">-</div>
                            <input class="cart-plus-minus-box" v-model="item.quantity" type="text">
                            <div class="inc qtybutton" @click="increaseItemQuantity(item.product, item.selectedOptions)">+</div>
                          </div>
                        </div>
                      </td>
                      <td class="product-subtotal">
                        <span class="amount">{{ getItemTotal(item) }} {{shop.devise}}</span  >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <div class="coupon-all mt-4">
                    <div class="coupon2">
                      <router-link to="/" class="btn btn--primary continue-btn ms-2">Continuer vos achats</router-link>
                      
                    </div>
                    <div class="coupon mt-4">
                      <h3 class="fw-bold mb-2">Coupon</h3>
                      <input id="coupon_code" v-model="formCode" class="input-text-coupon_code" name="coupon_code" value="" placeholder="Coupon code" type="text">
                      <button type="button" @click="applyPromo(cartTotal)" class="button btn btn--primary ms-2" name="apply_coupon">
                        Appliquer le coupon
                      
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 ml-auto">
                  <div class="cart-page-total mt-4">
                    <h2 class="fw-bold mb-3">Total du panier</h2>
                  
                    <ul>
                      <li>Total <span>{{ cartStore.getTotalPrice() }} {{shop.devise}}</span></li>
                      <!-- <li>Total <span>${{ cartStore.getTotalPrice() }}</span></li> -->
                    </ul>
                    <div class="button-box mt-3 text-end">
                      <!-- <router-link to="/checkout" class="proceed-checkout-btn btn btn--primary w-full">Proceed to checkout</router-link> -->
                      <button type="submit" class="proceed-checkout-btn btn btn--primary w-full">Passer à la caisse</button>
                     
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <Footer class="mt-5"/>
  </main>
</template>

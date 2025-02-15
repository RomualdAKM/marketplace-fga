<script setup>
import { ref, onMounted, computed, onBeforeUnmount, watch } from 'vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import { useCartStore } from '../../stores/cart';
import {
  openKkiapayWidget,
  addKkiapayListener,
  removeKkiapayListener,
} from "kkiapay";
import axios from 'axios';
import { useToast } from 'vue-toastification';

const cartStore = useCartStore();
const toast = useToast();

const form = ref({
  country_id: '',
  city_id: '',
  address: '',
  phone: '',
  fullName: '',
  email: '',
});

const countries = ref([]);
const cities = ref([]);
const cityPrice = ref(0);
const paypal = ref(null);
const selectedPaymentMethod = ref('');
const devise = ref('');
const isLoading = ref(false);
const formErrors = ref({});
const showPayPalButtons = ref(false);

const getCountries = async () => {
  try {
    const response = await axios.get('/api/get_countries');
    countries.value = response.data;
  } catch (error) {
    console.error('Error fetching countries:', error);
    toast.error('Unable to fetch countries. Please try again later.');
  }
};

const getCitiesInCountry = async () => {
  if (form.value.country_id) {
    try {
      const response = await axios.get(`/api/get_cities_by_country/${form.value.country_id}`);
      cities.value = response.data;
      form.value.city_id = ''; // Reset city selection when country changes
      cityPrice.value = 0; // Reset city price
    } catch (error) {
      console.error('Error fetching cities:', error);
      toast.error('Unable to fetch cities. Please try again later.');
    }
  }
};

const updateCityPrice = () => {
  const selectedCity = cities.value.find(city => city.id === form.value.city_id);
  cityPrice.value = selectedCity ? parseFloat(selectedCity.city_price) : 0;
};

const getTotal = computed(() => {
  const totalPrice = parseFloat(cartStore.getTotalPrice()) || 0;
  const deliveryPrice = parseFloat(cityPrice.value) || 0;
  return (totalPrice + deliveryPrice);
});

const storeOrder = async () => {
  try {
    isLoading.value = true;
    const response = await axios.post('/api/store_order', {
      items: cartStore.items,
      total_price: getTotal.value,
      ...form.value
    });
    console.log(response.data);
    toast.success('Order placed successfully!');
    cartStore.clearCart();
    // Redirect to a thank you page or order confirmation page
    // router.push('/thank-you');
  } catch (error) {
    console.error('Error placing order:', error);
    toast.error('Failed to place order. Please try again.');
  } finally {
    isLoading.value = false;
  }
};

const initPayPal = () => {
  if (window.paypal) {
    window.paypal.Buttons({
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: getTotal.value
            }
          }]
        });
      },
      onApprove: async (data, actions) => {
        try {
          const details = await actions.order.capture();
          console.log('Payment completed', details);
          await storeOrder();
          toast.success('Payment successful!');
        } catch (error) {
          console.error('PayPal payment failed:', error);
          toast.error('Payment failed. Please try again.');
        }
      }
    }).render('#paypal-button-container');
  }
};

const shop = ref('')

const getShop = async () => {
    await axios
        .get("/api/get_shop")
        .then((res) => {
            if (res.data) {
                shop.value = res.data;
                devise.value = shop.value.devise
            }

            console.log("shop devise", shop.value.devise);
        })
        .catch((err) => {
            console.log(err);
        });
};

const initKkiapay = () => {
  openKkiapayWidget({
    amount: getKkiapayAmount(),
    api_key: "e6d03d3d6591f35c24cc65ce4c05ef2cec26e9c5",
    sandbox: false,
    phone: form.value.phone,
  });
};

const getKkiapayAmount = () => {
  let amount = parseFloat(getTotal.value);
  if (devise.value === '$') {
    amount = amount * 550;
  } else if (devise.value === '€') {
    amount = amount * 655;
  }
  return Math.round(amount); // Kkiapay requires integer values
};

const successHandler = async (response) => {
  console.log('Kkiapay payment successful', response);
  try {
    await storeOrder();
    toast.success('Payment successful!');
  } catch (error) {
    console.error('Error processing Kkiapay payment:', error);
    toast.error('Error processing payment. Please contact support.');
  }
};

const validateForm = () => {
  formErrors.value = {};

  if (!form.value.fullName) formErrors.value.fullName = 'Full name is required';
  if (!form.value.email) formErrors.value.email = 'Email is required';
  if (!/^\S+@\S+\.\S+$/.test(form.value.email)) formErrors.value.email = 'Invalid email format';
  if (!form.value.phone) formErrors.value.phone = 'Phone number is required';
  if (!form.value.country_id) formErrors.value.country_id = 'Country is required';
  if (!form.value.city_id) formErrors.value.city_id = 'City is required';
  if (!form.value.address) formErrors.value.address = 'Address is required';

  return Object.keys(formErrors.value).length === 0;
};

const processPayment = async () => {
  if (!validateForm()) {
    toast.error('Please fill in all required fields correctly.');
    return;
  }

  if (!selectedPaymentMethod.value) {
    toast.error('Please select a payment method.');
    return;
  }

  try {
    isLoading.value = true;
    if (selectedPaymentMethod.value === 'paypal') {
      showPayPalButtons.value = true;
    } else if (selectedPaymentMethod.value === 'kkiapay') {
      initKkiapay();
    }
  } catch (error) {
    console.error('Error processing payment:', error);
    toast.error('An error occurred while processing your payment. Please try again.');
  } finally {
    isLoading.value = false;
  }
};

watch(() => selectedPaymentMethod.value, (newValue) => {
  showPayPalButtons.value = newValue === 'paypal';
});


onMounted(async () => {
  await getShop();
  await getCountries();
  addKkiapayListener('success', successHandler);

  const script = document.createElement('script');
  script.src = `https://www.paypal.com/sdk/js?client-id=AWcjjWHbE8Jk0qEAOXEafFHToc-GIw920SitXGYWRPiOneHN00QJuZ-a0a4Jts78MphXgQ1DLeUh22su&currency=EUR`;
  script.addEventListener('load', initPayPal);
  document.body.appendChild(script);
});

onBeforeUnmount(() => {
  removeKkiapayListener('success', successHandler);
});

</script>
<template>
  <Header />
  <main>
    <section class="breadcrumb-section-two">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="breadcrumb-content">
              <h2 class="visually-hidden">Paiement</h2>
            
              <ul class="breadcrumb-page-list">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item"><span class="active">Paiement</span></li>
         
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="page-section-wrapper section-space-ptb">
      <div class="container">
        <div class="checkout-details-wrapper">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="billing-details-wrap bg-blue-100">
                <form @submit.prevent="processPayment">
                  <h3 class="shoping-checkboxt-title">Détails de la facturation</h3>

                  <div class="row">
                    <div class="col-lg-12">
                      <p class="single-form-row">
                        <label>Nom complet <span class="required">*</span></label>
                        <input type="text" v-model="form.fullName" :class="{ 'is-invalid': formErrors.fullName }">
                        <span v-if="formErrors.fullName" class="invalid-feedback">{{ formErrors.fullName }}</span>
                      </p>
                    </div>
                    <div class="col-lg-12">
                      <p class="single-form-row">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" v-model="form.email" :class="{ 'is-invalid': formErrors.email }">
                        <span v-if="formErrors.email" class="invalid-feedback">{{ formErrors.email }}</span>
                      </p>
                    </div>
                    <div class="col-lg-12">
                      <p class="single-form-row">
                        <label>Numéro de téléphone<span class="required">*</span></label>
                        <input type="tel" v-model="form.phone" :class="{ 'is-invalid': formErrors.phone }">
                        <span v-if="formErrors.phone" class="invalid-feedback">{{ formErrors.phone }}</span>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
              <div class="billing-details-wrap bg-blue-100"
                style="background-color: #e6efff; padding: 15px; border-radius: 5px;">
                <form @submit.prevent="processPayment">
                  <h3 class="shoping-checkboxt-title">Détails de Livraison</h3>
               
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="nice-select wide">
                        <label>Pays <span class="required">*</span></label>
                      
                        <select v-model="form.country_id" @change="getCitiesInCountry"
                          :class="{ 'is-invalid': formErrors.country_id }">
                          <option value="" disabled>Sélectionnez un pays...</option>

                          <option v-for="country in countries" :key="country.id" :value="country.id">
                            {{ country.country_name }}</option>
                        </select>
                        <span v-if="formErrors.country_id" class="invalid-feedback">{{ formErrors.country_id }}</span>
                      </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                      <div class="nice-select wide">
                        <label>Ville <span class="required">*</span></label>

                        <select v-model="form.city_id" @change="updateCityPrice"
                          :class="{ 'is-invalid': formErrors.city_id }">
                          <option value="" disabled>Choisissez une ville...</option>
                        
                          <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.city_name }} {{
                            city.city_price }} <span v-if="shop.devise">{{shop.devise}}</span></option>
                        </select>
                        <span v-if="formErrors.city_id" class="invalid-feedback">{{ formErrors.city_id }}</span>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <p class="single-form-row mt-3">
                        <label>Adresse <span class="required">*</span></label>
                      
                        <input type="text" v-model="form.address" :class="{ 'is-invalid': formErrors.address }">
                        <span v-if="formErrors.address" class="invalid-feedback">{{ formErrors.address }}</span>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="your-order-wrapper ms-lg-5">
                <h3 class="shoping-checkboxt-title">Votre commande</h3>
              
                <div class="your-order-wrap">
                  <div class="your-order-table table-responsive">
                    <table>
                      <tfoot>
                        <tr class="order-total">
                          <th>Total de la commande</th>
                         
                          <td><strong><span class="amount">{{ cartStore.getTotalPrice() }} <span v-if="shop.devise">{{shop.devise}}</span></span></strong></td>
                        </tr>
                        <tr class="order-total">
                          <th>Frais de Livraison</th>
                         
                          <td><strong><span class="amount">{{ cityPrice }} <span v-if="shop.devise">{{shop.devise}}</span></span></strong></td>
                        </tr>
                        <tr class="order-total">
                          <th>Total</th>
                          <td><strong><span class="amount">{{ getTotal }} <span v-if="shop.devise">{{shop.devise}}</span></span></strong></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="payment-method">
                    <div class="payment-accordion">
                      <div class="accordion-item">
                        <span class="payment-accordion-item-button">
                          <input type="radio" id="payPal" name="paymentsSelector" value="paypal"
                            v-model="selectedPaymentMethod">
                          <label for="payPal">PayPal</label>
                        </span>
                        <p class="payments-text-body">Payer via PayPal. Vous pouvez payer avec votre carte de crédit si vous n'avez pas de compte PayPal.</p>

                      </div>
                      <div class="accordion-item">
                        <span class="payment-accordion-item-button">
                          <input type="radio" id="kkiapay" name="paymentsSelector" value="kkiapay"
                            v-model="selectedPaymentMethod">
                          <label for="kkiapay">Kkiapay</label>
                        </span>
                        <p class="payments-text-body">Payer avec Kkiapay</p>
                      
                      </div>
                    </div>
                    <div id="paypal-button-container" v-show="showPayPalButtons"></div>
                    <p class="text mt-4">Vos informations personnelles seront utilisées pour traiter votre commande, prendre en charge votre expérience.
                    </p>
                    <div class="order-button-payment">
                      <button type="submit" :disabled="isLoading" @click="processPayment">
                        {{ isLoading ? 'Traitement en cours...' : 'Passer la commande' }}
                    
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <Footer class="mt-5" />
  </main>
</template>

<style scoped>
.invalid-feedback {
  color: red;
  font-size: 0.875em;
}

.is-invalid {
  border-color: red;
}

button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
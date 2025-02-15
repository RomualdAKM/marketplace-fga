<script setup>
import { ref, computed } from 'vue'

const products = ref([
  {
    id: 1,
    title: 'Premium Headphones',
    price: 299.99,
    rating: 4.8,
    sales: 1234,
    image: 'https://placehold.co/400x400',
    seller: {
      name: 'Audio Elite',
      badge: 'Premium Seller',
      rating: 4.9
    },
    category: 'Audio',
    tags: ['Wireless', 'Noise Cancelling']
  },
  // ... autres produits
])

const categories = ref([
  { name: 'Électronique', icon: '📱', count: 1234, color: 'bg-blue-100 text-blue-800' },
  { name: 'Mode', icon: '👕', count: 2341, color: 'bg-pink-100 text-pink-800' },
  { name: 'Maison', icon: '🏠', count: 1876, color: 'bg-green-100 text-green-800' },
  { name: 'Sport', icon: '⚽', count: 945, color: 'bg-orange-100 text-orange-800' },
  { name: 'Beauté', icon: '💄', count: 1543, color: 'bg-purple-100 text-purple-800' },
  { name: 'Jardin', icon: '🌿', count: 732, color: 'bg-emerald-100 text-emerald-800' },
  { name: 'Auto', icon: '🚗', count: 654, color: 'bg-red-100 text-red-800' },
  { name: 'Jouets', icon: '🎲', count: 1234, color: 'bg-yellow-100 text-yellow-800' },
  { name: 'Livres', icon: '📚', count: 2156, color: 'bg-cyan-100 text-cyan-800' },
  { name: 'Art', icon: '🎨', count: 876, color: 'bg-violet-100 text-violet-800' },
  { name: 'Musique', icon: '🎵', count: 943, color: 'bg-rose-100 text-rose-800' },
  { name: 'High-Tech', icon: '💻', count: 1654, color: 'bg-indigo-100 text-indigo-800' }
])

// État des filtres
const filters = ref({
  priceRange: [0, 1000],
  rating: 0,
  condition: [],
  shipping: [],
  availability: false
})

const showFilters = ref(false)
const selectedCategory = ref('Tout')
const searchQuery = ref('')
const activeView = ref('grid')

// Prix minimum et maximum pour le slider
const minPrice = ref(0)
const maxPrice = ref(1000)

// Options pour les filtres
const conditions = ['Neuf', 'Très bon état', 'Bon état', 'État satisfaisant']
const shippingOptions = ['Livraison gratuite', 'Livraison express', 'Click & Collect']

// Produits filtrés
const filteredProducts = computed(() => {
  return products.value.filter(product => {
    const matchesPrice = product.price >= filters.value.priceRange[0] &&
                        product.price <= filters.value.priceRange[1]
    const matchesRating = filters.value.rating === 0 || product.rating >= filters.value.rating
    const matchesCondition = filters.value.condition.length === 0 ||
                            filters.value.condition.includes(product.condition)
    const matchesShipping = filters.value.shipping.length === 0 ||
                           filters.value.shipping.some(s => product.shipping.includes(s))
    const matchesAvailability = !filters.value.availability || product.inStock

    return matchesPrice && matchesRating && matchesCondition &&
           matchesShipping && matchesAvailability
  })
})


</script>

<template>
    <!-- Navigation -->
 <nav class="fixed w-full bg-white/80 backdrop-blur-md z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <router-link to="/home/index" class="flex items-center">
                    <i class="fas fa-shopping-bag text-2xl text-indigo-600"></i>
                    <span class="ml-2 text-xl font-bold text-gray-900">MarketPlace</span>
                </router-link>
                <div class="hidden md:flex space-x-8">
                    <a href="#how-it-works" class="text-gray-600 hover:text-gray-900">Comment ça marche</a>
                    <a href="#features" class="text-gray-600 hover:text-gray-900">Fonctionnalités</a>
                    <a href="#price" class="text-gray-600 hover:text-gray-900">Tarifs</a>
                    <router-link to="/home/marketplace" class="text-gray-600 hover:text-gray-900">Marketplace</router-link>
                </div>
                <div class="flex items-center space-x-4">
                    <router-link to="/home/login" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                        Connexion
                    </router-link>
                    <router-link to="/home/register" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Inscription
                    </router-link>
                </div>
            </div>
        </div>
    </nav>
  <div class="min-h-screen bg-gray-50 mt-8">
    <!-- Banner Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-indigo-800 to-indigo-900">
      <!-- Éléments décoratifs -->
      <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,...')] opacity-10"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500 rounded-full filter blur-3xl opacity-20"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-purple-500 rounded-full filter blur-3xl opacity-20"></div>
      </div>

      <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
          <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
            Trouvez les meilleurs produits aux meilleurs prix
          </h1>
          <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
            Des milliers de produits vérifiés, des vendeurs certifiés et une expérience d'achat unique
          </p>

          <!-- Barre de recherche améliorée -->
          <div class="relative max-w-3xl mx-auto">
            <input
              v-model="searchQuery"
              type="text"
              class="w-full px-8 py-6 rounded-2xl text-gray-800 text-lg shadow-2xl focus:ring-4 focus:ring-indigo-300 transition-all duration-300 pr-36"
              placeholder="Que recherchez-vous ?"
            >
            <button class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-indigo-600 text-white px-8 py-3 rounded-xl font-medium hover:bg-indigo-700 transition-colors duration-300 shadow-lg">
              Rechercher
            </button>
          </div>

          <!-- Stats rapides -->
          <div class="flex justify-center gap-8 mt-12 text-white">
            <div>
              <div class="text-3xl font-bold">100K+</div>
              <div class="text-indigo-200">Produits</div>
            </div>
            <div>
              <div class="text-3xl font-bold">50K+</div>
              <div class="text-indigo-200">Vendeurs</div>
            </div>
            <div>
              <div class="text-3xl font-bold">1M+</div>
              <div class="text-indigo-200">Clients</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation des catégories -->
    <div class="bg-white shadow-sm sticky top-0 z-20">
      <div class="container mx-auto px-4">
        <div class="flex items-center gap-4 overflow-x-auto py-4 scrollbar-hide">
          <button
            class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 whitespace-nowrap hover:bg-gray-100"
            :class="selectedCategory === 'Tout' ? 'bg-indigo-600 text-white' : ''"
            @click="selectedCategory = 'Tout'"
          >
            <span class="font-medium">Tout</span>
          </button>

          <button
            v-for="cat in categories"
            :key="cat.name"
            :class="[
              'flex items-center space-x-2 px-4 py-2 rounded-lg transition-all duration-300 whitespace-nowrap',
              selectedCategory === cat.name ? 'bg-indigo-600 text-white' : 'hover:bg-gray-100',
              cat.color
            ]"
            @click="selectedCategory = cat.name"
          >
            <span class="text-xl">{{ cat.icon }}</span>
            <span class="font-medium">{{ cat.name }}</span>
            <span class="text-sm opacity-75">({{ cat.count }})</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Panneau de filtres -->
    <div
      v-show="showFilters"
      class="fixed inset-0 bg-black bg-opacity-50 z-30"
      @click.self="showFilters = false"
    >
      <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-lg transform transition-transform duration-300">
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold">Filtres</h3>
            <button @click="showFilters = false" class="text-gray-500 hover:text-gray-700">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Prix -->
          <div class="mb-6">
            <h4 class="font-medium mb-4">Prix</h4>
            <div class="flex items-center gap-4">
              <input
                type="number"
                v-model="filters.priceRange[0]"
                class="w-24 px-3 py-2 border rounded"
                :min="minPrice"
                :max="filters.priceRange[1]"
              >
              <span>à</span>
              <input
                type="number"
                v-model="filters.priceRange[1]"
                class="w-24 px-3 py-2 border rounded"
                :min="filters.priceRange[0]"
                :max="maxPrice"
              >
              <span>€</span>
            </div>
          </div>

          <!-- Note minimale -->
          <div class="mb-6">
            <h4 class="font-medium mb-4">Note minimale</h4>
            <div class="flex gap-2">
              <button
                v-for="rating in 5"
                :key="rating"
                @click="filters.rating = rating"
                :class="[
                  'p-2 rounded transition-colors',
                  filters.rating >= rating ? 'text-yellow-400' : 'text-gray-300'
                ]"
              >
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </button>
            </div>
          </div>

          <!-- État -->
          <div class="mb-6">
            <h4 class="font-medium mb-4">État</h4>
            <div class="space-y-2">
              <label
                v-for="condition in conditions"
                :key="condition"
                class="flex items-center gap-2"
              >
                <input
                  type="checkbox"
                  v-model="filters.condition"
                  :value="condition"
                  class="rounded text-indigo-600 focus:ring-indigo-500"
                >
                {{ condition }}
              </label>
            </div>
          </div>

          <!-- Livraison -->
          <div class="mb-6">
            <h4 class="font-medium mb-4">Livraison</h4>
            <div class="space-y-2">
              <label
                v-for="option in shippingOptions"
                :key="option"
                class="flex items-center gap-2"
              >
                <input
                  type="checkbox"
                  v-model="filters.shipping"
                  :value="option"
                  class="rounded text-indigo-600 focus:ring-indigo-500"
                >
                {{ option }}
              </label>
            </div>
          </div>

          <!-- Disponibilité -->
          <div class="mb-6">
            <label class="flex items-center gap-2">
              <input
                type="checkbox"
                v-model="filters.availability"
                class="rounded text-indigo-600 focus:ring-indigo-500"
              >
              En stock uniquement
            </label>
          </div>

          <!-- Boutons d'action -->
          <div class="flex gap-4">
            <button
              @click="filters = { priceRange: [0, 1000], rating: 0, condition: [], shipping: [], availability: false }"
              class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
            >
              Réinitialiser
            </button>
            <button
              @click="showFilters = false"
              class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
            >
              Appliquer
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Filtres et Tri -->
    <div class="bg-white border-b">
      <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-4">
            <button
              @click="showFilters = !showFilters"
              class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
              </svg>
              Filtres
            </button>

            <div class="flex items-center gap-2">
              <button
                @click="activeView = 'grid'"
                :class="['p-2 rounded-lg transition-colors', activeView === 'grid' ? 'bg-gray-100' : 'hover:bg-gray-100']"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
              </button>
              <button
                @click="activeView = 'list'"
                :class="['p-2 rounded-lg transition-colors', activeView === 'list' ? 'bg-gray-100' : 'hover:bg-gray-100']"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </button>
            </div>
          </div>

          <select class="px-4 py-2 border rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <option>Recommandés</option>
            <option>Prix croissant</option>
            <option>Prix décroissant</option>
            <option>Meilleures ventes</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Grille de produits -->
    <div class="container mx-auto px-4 py-8">
      <div :class="[
        activeView === 'grid'
          ? 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6'
          : 'space-y-4'
      ]">
        <div
          v-for="product in products"
          :key="product.id"
          :class="[
            'group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden',
            activeView === 'list' ? 'flex gap-6' : ''
          ]"
        >
          <!-- Image du produit -->
          <div :class="['relative overflow-hidden', activeView === 'list' ? 'w-48' : 'w-full']">
            <img
              :src="product.image"
              :class="[
                'object-cover transition-transform duration-700 group-hover:scale-110',
                activeView === 'list' ? 'h-48 w-48' : 'h-72 w-full'
              ]"
              :alt="product.title"
            >
            <div class="absolute top-3 right-3 flex flex-col gap-2">
              <button class="p-2 rounded-full bg-white shadow-md hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
              </button>
            </div>
          </div>

          <!-- Informations produit -->
          <div class="p-4 flex-1">
            <div class="flex items-center justify-between mb-2">
              <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium">
                {{ product.category }}
              </span>
              <div class="flex items-center text-yellow-400">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-600">{{ product.rating }}</span>
              </div>
            </div>

            <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-indigo-600 transition-colors">
              {{ product.title }}
            </h3>

            <div class="flex items-center gap-4 mb-4">
              <span class="text-2xl font-bold text-indigo-600">{{ product.price }}€</span>
              <span class="text-sm text-gray-500">{{ product.sales }} ventes</span>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                  {{ product.seller.name.charAt(0) }}
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900">{{ product.seller.name }}</p>
                  <p class="text-xs text-gray-500">{{ product.seller.badge }}</p>
                </div>
              </div>

              <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                Voir détails
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.bg-pattern {
  background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

</style>

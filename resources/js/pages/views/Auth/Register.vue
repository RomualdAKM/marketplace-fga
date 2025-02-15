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
    <div class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-50 to-white flex items-center justify-center p-4">
      <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl p-8 relative overflow-hidden">
        <!-- Progress bar -->
        <div class="mb-8">
          <div class="flex justify-between mb-3">
            <div v-for="(step, index) in steps" :key="index"
                 class="flex flex-col items-center w-1/4 relative">
              <div :class="`w-10 h-10 rounded-full border-2 flex items-center justify-center
                           ${currentStep > index ? 'bg-indigo-600 border-indigo-600 text-white' :
                            currentStep === index ? 'border-indigo-600 text-indigo-600' :
                            'border-gray-300 text-gray-300'}`">
                {{ index + 1 }}
              </div>
              <div :class="`text-xs mt-2 font-medium ${currentStep >= index ? 'text-indigo-600' : 'text-gray-400'}`">
                {{ step.title }}
              </div>
              <div v-if="index < steps.length - 1"
                   :class="`absolute left-1/2 top-5 w-full h-0.5
                           ${currentStep > index ? 'bg-indigo-600' : 'bg-gray-300'}`">
              </div>
            </div>
          </div>
        </div>

        <!-- Form content -->
        <div class="relative">
          <transition-group name="slide" mode="out-in">
            <!-- Step 1: Informations personnelles -->
            <div v-if="currentStep === 0" key="step1" class="space-y-6">
              <div class="text-center mb-8">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                  Commençons par vous connaître
                </h2>
                <p class="text-gray-600 mt-2">Parlez-nous un peu de vous</p>
              </div>

              <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2 md:col-span-1">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                  <input type="text" v-model="formData.firstName"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="Votre prénom">
                </div>
                <div class="col-span-2 md:col-span-1">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                  <input type="text" v-model="formData.lastName"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="Votre nom">
                </div>
                <div class="col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Email professionnel</label>
                  <input type="email" v-model="formData.email"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="votreemail@exemple.com">
                </div>
                <div class="col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                  <input type="tel" v-model="formData.phone"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="+33 6 XX XX XX XX">
                </div>
              </div>
            </div>

            <!-- Step 2: Informations boutique -->
            <div v-if="currentStep === 1" key="step2" class="space-y-6">
              <div class="text-center mb-8">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                  Votre boutique
                </h2>
                <p class="text-gray-600 mt-2">Donnez vie à votre espace de vente</p>
              </div>

              <div class="space-y-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la boutique</label>
                  <input type="text" v-model="formData.shopName"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="Le nom de votre boutique">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                  <textarea v-model="formData.description" rows="4"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                           placeholder="Décrivez votre boutique en quelques mots..."></textarea>
                </div>
                <div class="grid grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie principale</label>
                    <select v-model="formData.category"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                      <option value="">Sélectionnez une catégorie</option>
                      <option value="mode">Mode</option>
                      <option value="electronics">Électronique</option>
                      <option value="home">Maison & Déco</option>
                      <option value="beauty">Beauté & Bien-être</option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                    <select v-model="formData.country"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                      <option value="">Sélectionnez un pays</option>
                      <option value="FR">France</option>
                      <option value="BE">Belgique</option>
                      <option value="CH">Suisse</option>
                      <option value="CA">Canada</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- Step 3: Informations légales -->
            <div v-if="currentStep === 2" key="step3" class="space-y-6">
              <div class="text-center mb-8">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                  Informations légales
                </h2>
                <p class="text-gray-600 mt-2">Les détails importants pour votre activité</p>
              </div>

              <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2 md:col-span-1">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Numéro SIRET</label>
                  <input type="text" v-model="formData.siret"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="XXX XXX XXX XXXXX">
                </div>
                <div class="col-span-2 md:col-span-1">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Numéro TVA (optionnel)</label>
                  <input type="text" v-model="formData.tva"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="FR XXXXXXXXX">
                </div>
              </div>
            </div>

            <!-- Step 4: Sécurité -->
            <div v-if="currentStep === 3" key="step4" class="space-y-6">
              <div class="text-center mb-8">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                  Dernière étape
                </h2>
                <p class="text-gray-600 mt-2">Sécurisez votre compte</p>
              </div>

              <div class="space-y-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                  <input type="password" v-model="formData.password"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="••••••••">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                  <input type="password" v-model="formData.confirmPassword"
                         class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                         placeholder="••••••••">
                </div>
                <div class="flex items-start space-x-3 mt-6">
                  <input type="checkbox" v-model="formData.acceptTerms"
                         class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                  <label class="text-sm text-gray-600">
                    J'accepte les <a href="#" class="text-indigo-600 hover:text-indigo-500">conditions d'utilisation</a> et la
                    <a href="#" class="text-indigo-600 hover:text-indigo-500">politique de confidentialité</a>
                  </label>
                </div>
              </div>
            </div>
          </transition-group>
        </div>

        <!-- Navigation buttons -->
        <div class="flex justify-between mt-8">
          <button v-if="currentStep > 0" @click="previousStep"
                  class="px-6 py-3 rounded-xl border border-indigo-600 text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
            Retour
          </button>
          <div></div>
          <button v-if="currentStep < steps.length - 1" @click="nextStep"
                  class="px-6 py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition-colors duration-200">
            Continuer
          </button>
          <button v-else @click="submitForm"
                  class="px-6 py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition-colors duration-200">
            Créer ma boutique
          </button>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue'

  const currentStep = ref(0)
  const steps = [
    { title: 'Profil' },
    { title: 'Boutique' },
    { title: 'Légal' },
    { title: 'Sécurité' }
  ]

  const formData = ref({
    // Étape 1
    firstName: '',
    lastName: '',
    email: '',
    phone: '',

    // Étape 2
    shopName: '',
    description: '',
    category: '',
    country: '',

    // Étape 3
    siret: '',
    tva: '',

    // Étape 4
    password: '',
    confirmPassword: '',
    acceptTerms: false
  })

  const nextStep = () => {
    if (currentStep.value < steps.length - 1) {
      currentStep.value++
    }
  }

  const previousStep = () => {
    if (currentStep.value > 0) {
      currentStep.value--
    }
  }

  const submitForm = () => {
    // Logique de soumission du formulaire
    console.log(formData.value)
  }
  </script>

  <style scoped>
  .slide-enter-active,
  .slide-leave-active {
    transition: all 0.3s ease;
  }

  .slide-enter-from {
    opacity: 0;
    transform: translateX(30px);
  }

  .slide-leave-to {
    opacity: 0;
    transform: translateX(-30px);
  }
  </style>

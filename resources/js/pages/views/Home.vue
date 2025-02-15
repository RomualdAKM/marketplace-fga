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

    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">La marketplace qui réinvente</span>
                    <span class="block text-indigo-600">l'expérience shopping</span>
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
                    Découvrez une nouvelle façon d'acheter et de vendre. Notre plateforme connecte acheteurs et vendeurs dans un environnement sécurisé et intuitif.
                </p>
                <div class="mt-10 flex justify-center space-x-4">
                    <button class="px-8 py-3 text-base font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Commencer maintenant
                    </button>
                    <button class="px-8 py-3 text-base font-medium text-indigo-600 bg-white border border-indigo-600 rounded-lg hover:bg-indigo-50 transition duration-300">
                        En savoir plus
                    </button>
                </div>
                <div class="mt-12 w-full mx-auto">
                    <div class="bg-indigo-600 ">
                        <video
                            class="w-full rounded-lg shadow-2xl border-2 border-indigo-600"
                            controls
                            autoplay
                            muted
                            loop
                            preload="auto"
                        >
                            <source src="/illustration-video-landing-page.mp4" type="video/mp4">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-16">Ils réussissent avec Chariow</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Témoignage 1 -->
            <div class="flex flex-col items-center text-center">
                <img src="/img/slide-2.jpg" alt="Maurice NONTONDJI" class="w-24 h-24 rounded-full mb-6">
                <p class="text-gray-700 mb-6">"J'ai adoré la simplicité du service et ses fonctionnalités pratiques. Elles vont m'aider à vendre mes produits et services en ligne sans effort !"</p>
                <h3 class="font-semibold text-gray-900">Maurice NONTONDJI</h3>
                <p class="text-gray-600">Linkedin Community Manager</p>
            </div>

            <!-- Témoignage 2 -->
            <div class="flex flex-col items-center text-center">
                <img src="/img/slide-1.jpg" alt="Godwin SOOLA" class="w-24 h-24 rounded-full mb-6">
                <p class="text-gray-700 mb-6">"Chariow offre une interface intuitive et des outils puissants, comme l'intégration du Pixel Meta Ads. Le système de création de produits est simple et efficace. Avec Chariow, on va révolutionner internet !"</p>
                <h3 class="font-semibold text-gray-900">Godwin SOOLA</h3>
                <p class="text-gray-600">Digital Marketer</p>
            </div>

            <!-- Témoignage 3 -->
            <div class="flex flex-col items-center text-center">
                <img src="/img/slide-3.jpg" alt="Hermas AYI" class="w-24 h-24 rounded-full mb-6">
                <p class="text-gray-700 mb-6">"Chariow est l'outil idéal pour lancer des produits rapidement sans souci de création de site ou d'intégration de paiements. Interface conviviale et simple, accessible sur mobile et tout support."</p>
                <h3 class="font-semibold text-gray-900">Hermas AYI</h3>
                <p class="text-gray-600">CoFounder Ibudo</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <!-- Colonne de gauche -->
            <div class="w-full md:w-1/2 space-y-6">
                <h2 class="text-4xl md:text-5xl font-serif font-bold leading-tight">
                    Votre boutique personnalisée en ligne en 2 minutes.
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Chariow vous permet de configurer plusieurs boutiques adaptées à vos différents produits ou services. Choisissez un design, ajoutez vos articles, et vous êtes prêt à vendre.
                </p>
                <div class="pt-4">
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-white border-2 border-black rounded-full text-black font-medium hover:bg-black hover:text-white transition-colors duration-300">
                        Créez une boutique gratuite
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="w-full md:w-1/2">
                <div class="bg-gray-50 p-8 rounded-3xl shadow-lg">
                    <img src="/img/slide-2.jpg" alt="Illustration E-commerce" class="w-full">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Comment ça marche -->
<section class="py-20 bg-indigo-600" id="how-it-works">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Titre -->
      <h2 class="text-4xl font-bold text-white text-center mb-20">
        Comment ça marche ?
      </h2>

      <div class="grid md:grid-cols-2 gap-20 items-center">
        <!-- Colonne de gauche - Les étapes -->
        <div class="space-y-16">
          <!-- Étape 1 -->
          <div class="flex items-start gap-6">
            <span class="text-7xl font-bold text-white">1</span>
            <div>
              <h3 class="text-2xl font-semibold text-white mb-2">Créez</h3>
              <p class="text-white/90 text-lg">
                Uploadez vos produits numériques et configurez votre boutique.
              </p>
            </div>
          </div>

          <!-- Étape 2 -->
          <div class="flex items-start gap-6">
            <span class="text-7xl font-bold text-white">2</span>
            <div>
              <h3 class="text-2xl font-semibold text-white mb-2">Partagez</h3>
              <p class="text-white/90 text-lg">
                Diffusez votre lien de vente unique sur vos réseaux.
              </p>
            </div>
          </div>

          <!-- Étape 3 -->
          <div class="flex items-start gap-6">
            <span class="text-7xl font-bold text-white">3</span>
            <div>
              <h3 class="text-2xl font-semibold text-white mb-2">Gagnez</h3>
              <p class="text-white/90 text-lg">
                Recevez vos paiements instantanément après chaque vente.
              </p>
            </div>
          </div>
        </div>

        <!-- Colonne de droite - Interface -->
        <div class="bg-white p-8 rounded-3xl shadow-xl">
          <div class="mb-4 flex justify-between items-center">
            <span class="text-gray-900 text-lg font-medium">FCFA 314,998</span>
            <button class="px-6 py-2 bg-black text-white text-sm rounded-full">
              Accéder à mon portefeuille
            </button>
          </div>

          <!-- Cercles avec lignes de connexion -->
          <div class="relative mt-12">
            <div class="flex justify-between items-center relative">
              <!-- Les cercles gris -->
              <div class="w-16 h-16 bg-gray-100 rounded-full"></div>
              <div class="w-16 h-16 bg-gray-100 rounded-full"></div>
              <div class="w-16 h-16 bg-gray-100 rounded-full"></div>
            </div>

            <!-- Grand cercle du bas -->
            <div class="mt-16 flex justify-center">
              <div class="w-24 h-24 bg-gray-100 rounded-full"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-20 bg-white" id="features">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-center text-gray-900 mb-16">
        Fonctionnalités clés
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Protection des PDF -->
        <div class="flex flex-col items-start">
          <div class="p-3 bg-indigo-100 rounded-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Protection des PDF</h3>
          <p class="text-gray-600">Protégez vos fichiers PDF avec des filigranes personnalisés uniques pour sécuriser votre contenu.</p>
        </div>

        <!-- Workflows -->
        <div class="flex flex-col items-start">
          <div class="p-3 bg-indigo-100 rounded-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Workflows</h3>
          <p class="text-gray-600">Soyez plus efficaces grâce aux workflows. Idéal pour les notes de remerciement, les ventes incitatives et bien plus encore !</p>
        </div>

        <!-- Code de réduction -->
        <div class="flex flex-col items-start">
          <div class="p-3 bg-indigo-100 rounded-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Code de réduction</h3>
          <p class="text-gray-600">Offrez à vos clients des réductions sur vos produits avec une flexibilité totale, que ce soit en pourcentage ou en montant fixe.</p>
        </div>

        <!-- Pulse -->
        <div class="flex flex-col items-start">
          <div class="p-3 bg-indigo-100 rounded-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Pulse</h3>
          <p class="text-gray-600">Communiquez vos ventes à vos outils préférés tels que Zapier, Make en tant que reel et conservez votre flux de travail intact.</p>
        </div>

        <!-- Campagne -->
        <div class="flex flex-col items-start">
          <div class="p-3 bg-indigo-100 rounded-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Campagne</h3>
          <p class="text-gray-600">Mesurez l'impact réel de chaque action marketing et optimisez votre ROI grâce à une meilleure traçabilité.</p>
        </div>

        <!-- Et plus encore -->
        <div class="flex flex-col items-start">
          <div class="p-3 bg-indigo-100 rounded-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Et plus encore</h3>
          <p class="text-gray-600">Explorez nos fonctionnalités avancées comme les noms de domaines personnalité, le multi-devises et bien d'autres pour développer votre business</p>
        </div>
      </div>
    </div>
  </section>

  <section class="w-full py-20 bg-white text-center" id="price">
    <h1 class="text-4xl  mb-6">Tarification</h1>

    <h1 class="text-8xl font-serif mb-12">15% flat</h1>

    <div class="flex justify-center gap-8 mb-6">
        <div class="flex items-center gap-2">
            <svg viewBox="0 0 24 24" class="w-6 h-6" fill="none" stroke="currentColor">
                <path d="M20 6L9 17l-5-5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Pas de frais mensuels.</span>
        </div>

        <div class="flex items-center gap-2">
            <svg viewBox="0 0 24 24" class="w-6 h-6" fill="none" stroke="currentColor">
                <path d="M20 6L9 17l-5-5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Pas de frais cachés.</span>
        </div>
    </div>

    <p class="text-gray-600 mb-12">
        Vous ne payez que lorsque vous vendez. Pas de frais supplémentaires ni de surprises.
    </p>

    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-full transition duration-300">
        Créez votre boutique
    </button>
</section>

  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- En-tête de la section -->
      <div class="text-center max-w-3xl mx-auto mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Questions fréquentes</h2>
        <p class="text-lg text-gray-600">
          Trouvez rapidement les réponses à vos questions les plus courantes
        </p>
      </div>

      <!-- Liste des FAQ -->
      <div class="max-w-3xl mx-auto space-y-4">
        <div v-for="(faq, index) in faqs" :key="index">
          <button
            @click="toggleFaq(index)"
            class="w-full bg-white px-6 py-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 flex justify-between items-center"
            :class="{ 'rounded-b-none': activeIndex === index }"
          >
            <span class="text-left font-medium text-gray-900">{{ faq.question }}</span>
            <svg
              class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
              :class="{ 'rotate-180': activeIndex === index }"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"
              />
            </svg>
          </button>
          <div
            v-show="activeIndex === index"
            class="bg-white px-6 py-4 rounded-b-lg shadow-sm border-t border-gray-100"
          >
            <p class="text-gray-600">{{ faq.answer }}</p>
          </div>
        </div>
      </div>

      <!-- Call to action -->
      <div class="text-center mt-12">
        <p class="text-gray-600 mb-4">Vous ne trouvez pas la réponse que vous cherchez ?</p>
        <button class="inline-flex items-center px-6 py-3 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors duration-200">
          Contactez notre support
          <svg
            class="ml-2 w-4 h-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M14 5l7 7m0 0l-7 7m7-7H3"
            />
          </svg>
        </button>
      </div>
    </div>
  </section>
  <!-- Section Tarification -->
  <!-- <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-bold text-center mb-16">
        Des tarifs simples et transparents
      </h2>

      <div class="grid md:grid-cols-3 gap-8">

        <div class="border border-gray-200 rounded-2xl p-8 hover:shadow-lg transition-shadow duration-300">
          <h3 class="text-2xl font-bold mb-4">Gratuit</h3>
          <p class="text-gray-600 mb-6">Pour commencer</p>
          <div class="text-4xl font-bold mb-6">0 FCFA</div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              1 boutique
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              5 produits
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Support basique
            </li>
          </ul>
          <button class="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-300">
            Commencer gratuitement
          </button>
        </div>


        <div class="border-2 border-indigo-600 rounded-2xl p-8 shadow-lg relative">
          <div class="absolute top-0 right-0 bg-indigo-600 text-white px-4 py-1 rounded-bl-lg rounded-tr-xl text-sm">
            Populaire
          </div>
          <h3 class="text-2xl font-bold mb-4">Pro</h3>
          <p class="text-gray-600 mb-6">Pour les entrepreneurs</p>
          <div class="text-4xl font-bold mb-6">15,000 FCFA/mois</div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Boutiques illimitées
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Produits illimités
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Support prioritaire
            </li>
          </ul>
          <button class="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-300">
            Commencer l'essai gratuit
          </button>
        </div>


        <div class="border border-gray-200 rounded-2xl p-8 hover:shadow-lg transition-shadow duration-300">
          <h3 class="text-2xl font-bold mb-4">Entreprise</h3>
          <p class="text-gray-600 mb-6">Solutions personnalisées</p>
          <div class="text-4xl font-bold mb-6">Sur mesure</div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Tout ce qui est inclus dans Pro
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              API personnalisée
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              Support dédié 24/7
            </li>
          </ul>
          <button class="w-full py-3 border-2 border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors duration-300">
            Contactez-nous
          </button>
        </div>
      </div>
    </div>
  </section> -->

  <section class="min-h-screen bg-black text-white">
    <!-- Hero Section -->
    <div class="container mx-auto px-4 text-center py-20">
        <h1 class="text-4xl md:text-5xl font-bold mb-8 leading-tight">
            Commencez à vendre des produits
            <br>
            digitaux dès aujourd'hui !
        </h1>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-full transition duration-300">
            Créez votre boutique
        </button>
    </div>

    <hr class="border-gray-800">

    <!-- Footer -->
    <footer class="container mx-auto px-4 py-12 pl-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo et Description -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <img src="chariow-logo.png" alt="Chariow" class="h-8">
                </div>
                <p class="text-gray-400">
                    La plateforme tout en un
                    <br>
                    pour vendre vos produits
                    <br>
                    digitaux.
                </p>
                <!-- Social Media Icons -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Facebook</span>
                        <!-- Icons would go here -->
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Twitter</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Instagram</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">LinkedIn</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Telegram</span>
                    </a>
                </div>
                <!-- Language Selector -->
                <!-- <div class="relative inline-block">
                    <button class="flex items-center space-x-2 border border-gray-600 rounded-full px-4 py-2">
                        <span>🇫🇷</span>
                        <span>Français</span>
                    </button>
                </div> -->
            </div>

            <!-- Ressources -->
            <div>
                <h3 class="text-gray-400 mb-4">Ressources</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-white hover:text-gray-300">Centre d'aide</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Tarifs</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Roadmap</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-gray-400 mb-4">Legal</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-white hover:text-gray-300">Politique de confidentialité</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Termes et conditions</a></li>
                    <li class="flex items-center">
                        <span class="h-2 w-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-white">All services are online</span>
                    </li>
                </ul>
            </div>

            <!-- Entreprise -->
            <div>
                <h3 class="text-gray-400 mb-4">Entreprise</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-white hover:text-gray-300">A propos</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Équipe</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Carrières</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Newsroom</a></li>
                    <li><a href="#" class="text-white hover:text-gray-300">Contact</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Text -->
        <div class="mt-12 text-xs text-gray-500">
            Chariow est un service de Ava Zara LLC, une société américaine enregistrée dans l'État du Delaware. Ava Zara LLC est une société technologique agissant en tant que fournisseur de services logiciels, mais pas en tant que fournisseur de services de paiement ou marchand de référence. Les services de paiement et de facturation sont fournis par des prestataires de services agréés en partenariat avec MiMo Global Inc et ses filiales.
        </div>
    </footer>
</section>
</template>
<script setup>

import { ref } from 'vue'

const activeIndex = ref(null)

const toggleFaq = (index) => {
  activeIndex.value = activeIndex.value === index ? null : index
}

const faqs = ref([
  {
    question: "Comment créer ma première boutique en ligne ?",
    answer: "Créer votre boutique est simple et rapide : inscrivez-vous gratuitement, configurez vos informations de base, ajoutez vos produits et personnalisez votre design. En quelques minutes, votre boutique sera prête à accueillir vos premiers clients."
  },
  {
    question: "Quels sont les moyens de paiement acceptés ?",
    answer: "Nous acceptons une large gamme de moyens de paiement incluant les cartes bancaires (Visa, Mastercard), Mobile Money (MTN, Orange, Wave), et les virements bancaires. Tous les paiements sont sécurisés et traités instantanément."
  },
  {
    question: "Comment gérer mes commandes et mes stocks ?",
    answer: "Notre interface intuitive vous permet de suivre vos commandes en temps réel, gérer vos stocks et automatiser vos processus de vente. Vous recevez des notifications instantanées pour chaque nouvelle commande et pouvez gérer vos expéditions facilement."
  },
  {
    question: "Puis-je personnaliser l'apparence de ma boutique ?",
    answer: "Absolument ! Vous pouvez personnaliser entièrement l'apparence de votre boutique avec nos outils de design intuitifs. Choisissez parmi nos thèmes professionnels, modifiez les couleurs, les polices et la mise en page pour créer une boutique unique qui correspond à votre marque."
  },
  {
    question: "Quels sont les frais et commissions ?",
    answer: "Notre modèle de tarification est transparent : le plan gratuit vous permet de démarrer sans frais, avec des fonctionnalités de base. Pour plus de fonctionnalités, nos plans payants commencent à 15,000 FCFA par mois. Nous ne prenons aucune commission sur vos ventes."
  },
  {
    question: "Comment promouvoir ma boutique en ligne ?",
    answer: "Nous vous fournissons des outils marketing intégrés pour promouvoir votre boutique : création de codes promo, intégration avec les réseaux sociaux, analytics pour suivre vos performances, et possibilité de créer des campagnes marketing ciblées."
  }
])
</script>

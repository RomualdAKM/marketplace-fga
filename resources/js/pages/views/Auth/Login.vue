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
    <div class="min-h-screen bg-gradient-to-br from-indigo-100 to-white flex items-center justify-center p-4">
      <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8 space-y-8">
        <!-- Logo -->
        <div class="text-center">
          <h2 class="text-3xl font-bold text-gray-900">Connexion</h2>
          <p class="mt-2 text-sm text-gray-600">Accédez à votre espace MarketPlace</p>
        </div>

        <!-- Formulaire -->
        <form class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input
              type="email"
              class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input
              type="password"
              class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            >
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
              <label class="ml-2 block text-sm text-gray-700">Se souvenir de moi</label>
            </div>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Mot de passe oublié?</a>
          </div>

          <button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Se connecter
          </button>
        </form>

        <div class="text-center">
          <p class="text-sm text-gray-600">
            Pas encore de compte?
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">S'inscrire</a>
          </p>
        </div>
      </div>
    </div>
  </template>

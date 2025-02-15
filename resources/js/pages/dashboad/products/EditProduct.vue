<script setup>
import SideMenu from "../components/SideMenu.vue"
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'
import router from '../../../router/index.js'
import IsLoading from '../components/IsLoading.vue'

// Refs
const route = useRoute()
const product = ref({
  id: null,
  name: '',
  description: '',
  status: false,
  stock: 0,
  stock_alert: 0,
  base_price: 0,
  category_id: '',
  variations: [],
  images: []
})
const categories = ref([])
const imagePreviews = ref([])
const isLoading = ref(false)

// Fetch product details by ID
const fetchProduct = async () => {
  try {
    const response = await axios.get(`/api/get_product/${route.params.productId}`)
    const data = response.data

    product.value.id = data.id
    product.value.name = data.name
    product.value.description = data.description
    product.value.status = data.status === "true"
    product.value.stock = data.stock
    product.value.stock_alert = data.stock_alert
    product.value.base_price = parseFloat(data.base_price)
    product.value.category_id = data.category_id
    product.value.variations = data.productvariations.map(variation => ({
      name: variation.name,
      id: variation.id,
      options: variation.productvariationoptions.map(option => ({
        name: option.name,
        id: option.id,
        additional_price: parseFloat(option.additional_price)
      }))
    }))
    product.value.images = data.productimages.map(image => image.image_url)
    imagePreviews.value = product.value.images.map(image => '/storage/' + image)
    // imagePreviews.value = [ ...product.value.images]

  } catch (error) {
    console.error('Error fetching product data:', error)
  }
}

// Fetch categories
const getCategories = async () => {
  try {
    const response = await axios.get('/api/get_categories')
    categories.value = response.data
  } catch (error) {
    console.error('Error fetching categories:', error)
  }
}


// Handle image uploads
const handleImageUpload = (event) => {
  const files = Array.from(event.target.files)
  files.forEach(file => {
    const reader = new FileReader()
    reader.onload = (e) => {
      imagePreviews.value.push(e.target.result)
    }
    reader.readAsDataURL(file)
    product.value.images.push(file)
  })
}


// Remove image
const removeImage = (index) => {
  imagePreviews.value.splice(index, 1)
  product.value.images.splice(index, 1)
}

// Add variation
const addVariation = () => {
  if (product.value.variations.length > 0) {
    const lastIndex = product.value.variations.length - 1
    const lastVariationName = product.value.variations[lastIndex].name
    const existingVariation = product.value.variations.find(
      (variation, index) => variation.name === lastVariationName && index !== lastIndex
    )
    if (existingVariation) {
      toast.fire({
        icon: "error",
        title: "ce nom de variation existe deja",
      })
      return
    }
  }
  product.value.variations.push({
    name: '',
    options: [
      {
        name: '',
        additional_price: '',
      },
    ],
    options: [{ name: '', additional_price: 0 }]
  })
}

// Add option to a variation
const addOption = (variationIndex) => {
  const lastIndex = product.value.variations[variationIndex].options.length - 1
  const lastOptionName = product.value.variations[variationIndex].options[lastIndex].name
  const existingOption = product.value.variations[variationIndex].options.find(
    (option, index) => option.name === lastOptionName && index !== lastIndex
  )
  if (existingOption) {
    toast.fire({
      icon: "error",
      title: "ce nom d'option existe deja",
    })
    return
  } else {
    product.value.variations[variationIndex].options.push({
      name: '',
      additional_price: 0,
    })
  }
}


// Remove option from a variation


const removeOption = (variationIndex, optionIndex) => {
  if (product.value.variations[variationIndex].options.length === 1) {
    product.value.variations.splice(variationIndex, 1)
  } else {
    product.value.variations[variationIndex].options.splice(optionIndex, 1)
  }
 
}

// Handle form submission
const handleSubmit = async () => {
  try {
    isLoading.value = true
    const formData = new FormData()
    formData.append('name', product.value.name)
    formData.append('description', product.value.description)
    formData.append('base_price', product.value.base_price)
    formData.append('category_id', product.value.category_id)
    formData.append('status', product.value.status)
    formData.append('stock', product.value.stock)
    formData.append('stock_alert', product.value.stock_alert)
    
    product.value.variations.forEach((variation, index) => {
      formData.append(`variations[${index}][name]`, variation.name)
      formData.append(`variations[${index}][id]`, variation.id)
      variation.options.forEach((option, optionIndex) => {
        formData.append(`variations[${index}][options][${optionIndex}][name]`, option.name)
        formData.append(`variations[${index}][options][${optionIndex}][additional_price]`, option.additional_price)
        formData.append(`variations[${index}][options][${optionIndex}][id]`, option.id)
      })
    })

    product.value.images.forEach((image, index) => {
      if (typeof image === 'string') {
        formData.append(`existing_images[]`, image)
      } else {
        formData.append(`images[${index}]`, image)
      }
    })

    const response = await axios.post(`/api/update_product/${product.value.id}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    
    if (response.data.success) {
      isLoading.value = false
     // window.location.reload()
      toast.fire({
        icon: "success",
        title: "Produit modifié avec succès",
      })
      router.push('/dashboad/products')
    } else {
      isLoading.value = false
      console.log('error', response.data.message)
      toast.fire({
        icon: "error",
        title: "Veuillez remplir tous les champs requis",
      })
    }

  } catch (error) {
    isLoading.value = false
    console.error('Error in handleSubmit:', error)
    toast.fire({
      icon: "error",
      title: "Une erreur s'est produite lors de la soumission. Veuillez réessayer plus tard.",
    })
  }
}
const loading = ref(true)

// On component mount
onMounted(async () => {
    
    loading.value = true;

if (!sessionStorage.getItem('page033Reloaded')) {
    // Marquer que la page a été rechargée pour cette visite
    sessionStorage.setItem('page033Reloaded', true);
    
    // Recharger la page une seule fois
    window.location.reload();
   
} else {
    // Réinitialiser le marquage pour la prochaine visite
    sessionStorage.removeItem('page033Reloaded');
    loading.value = false;
   
}
  await getCategories()
  await fetchProduct()
})

</script>

<template>
    <div class="echo group bg-gradient-to-b from-slate-200/70 to-slate-50 background relative min-h-screen before:content-[''] before:h-[370px] before:w-screen before:bg-gradient-to-t before:from-theme-1/80 before:to-theme-2 [&.background--hidden]:before:opacity-0 before:transition-[opacity,height] before:ease-in-out before:duration-300 before:top-0 before:fixed after:content-[''] after:h-[370px] after:w-screen [&.background--hidden]:after:opacity-0 after:transition-[opacity,height] after:ease-in-out after:duration-300 after:top-0 after:fixed after:bg-texture-white after:bg-contain after:bg-fixed after:bg-[center_-13rem] after:bg-no-repeat">
      <div class="[&.loading-page--before-hide]:h-screen [&.loading-page--before-hide]:relative loading-page loading-page--before-hide [&.loading-page--before-hide]:before:block [&.loading-page--hide]:before:opacity-0 before:content-[''] before:transition-opacity before:duration-300 before:hidden before:inset-0 before:h-screen before:w-screen before:fixed before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:z-[60] [&.loading-page--before-hide]:after:block [&.loading-page--hide]:after:opacity-0 after:content-[''] after:transition-opacity after:duration-300 after:hidden after:h-16 after:w-16 after:animate-pulse after:fixed after:opacity-50 after:inset-0 after:m-auto after:bg-loading-puff after:bg-cover after:z-[61]">
        <SideMenu />
        <div class="content transition-[margin,width] duration-100 xl:pl-3.5 pt-[54px] pb-16 relative z-10 group mode content--compact xl:ml-[275px] mode--light [&.content--compact]:xl:ml-[91px]">
          <div class="mt-16 px-5">
            <div class="container">
              <div class="grid grid-cols-12 gap-x-6 gap-y-10">
                <div class="col-span-12">
                  <div class="flex flex-col mt-4 gap-y-3 md:mt-0 md:h-10 md:flex-row md:items-center">
                    <div class="text-base font-medium group-[.mode--light]:text-white">
                      Edit Product
                    </div>
                  </div>
                  <div class="mt-3.5 grid grid-cols-12 gap-x-6 gap-y-7 lg:gap-y-10 xl:grid-cols-10">
                    <div class="relative flex flex-col col-span-12 gap-y-7 lg:col-span-12 xl:col-span-12">
                      <div class="flex flex-col p-5 box box--stacked">
                        <div class="rounded-[0.6rem] border border-slate-200/60 p-5 dark:border-darkmode-400">
                          <div class="flex items-center border-b border-slate-200/60 pb-5 text-[0.94rem] font-medium dark:border-darkmode-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down w-5 h-5 mr-2 stroke-[1.3]">
                              <path d="m6 9 6 6 6-6"/>
                            </svg>
                            Product Information
                          </div>
                          <div class="mt-5">
                            <!-- Product Name -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Product Name</div>
                                    <div class="ml-2.5 rounded-md border bg-slate-100 px-2 py-0.5 text-xs text-slate-500">
                                      Required
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <input type="text" v-model="product.name" placeholder="Product Name" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                              </div>
                            </div>
  
                            <!-- Base Price -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Base Price</div>
                                    <div class="ml-2.5 rounded-md border bg-slate-100 px-2 py-0.5 text-xs text-slate-500">
                                      Required
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <input type="number" v-model="product.base_price" placeholder="Base Price" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                              </div>
                            </div>
  
                            <!-- Category -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Category</div>
                                    <div class="ml-2.5 rounded-md border bg-slate-100 px-2 py-0.5 text-xs text-slate-500">
                                      Required
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <select v-model="product.category_id" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                                  <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                  </option>
                                </select>
                              </div>
                            </div>
  
                            <!-- Status -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Status</div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <select v-model="product.status" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                                  <option value="true">Active</option>
                                  <option value="false">Inactive</option>
                                </select>
                              </div>
                            </div>
  
                            <!-- Stock -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Stock</div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <input type="number" v-model="product.stock" placeholder="Stock Quantity" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                              </div>
                            </div>
  
                            <!-- Stock Alert -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Stock Alert</div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <input type="number" v-model="product.stock_alert" placeholder="Stock Alert Level" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                              </div>
                            </div>
  
                            <!-- Product Description -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Product Description</div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <textarea v-model="product.description" placeholder="Product Description" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80"></textarea>
                              </div>
                            </div>
  
                            <!-- Product Images -->
                            <div class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Product Images</div>
                                    <div class="ml-2.5 rounded-md border bg-slate-100 px-2 py-0.5 text-xs text-slate-500">
                                      Required
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <input type="file" multiple @change="handleImageUpload($event)" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                                <div class="mt-4 flex flex-wrap">
                                  <div v-for="(image, index) in imagePreviews" :key="index" class="relative mr-4 mb-4">
                                    <img :src="image" alt="preview" class="w-24 h-24 object-cover rounded-md shadow-sm">
                                    <button @click="removeImage(index)" class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-1 text-xs">X</button>
                                  </div>
                                </div>
                              </div>
                            </div>
  
                            <!-- Product Variations -->
                            <div v-for="(variation, varIndex) in product.variations" :key="varIndex" class="flex-col block pt-5 mt-5 sm:flex xl:flex-row xl:items-center">
                              <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                <div class="text-left">
                                  <div class="flex items-center">
                                    <div class="font-medium">Nom Variation </div>
                                  </div>
                                </div>
                              </div>
                              <div class="flex-1 w-full mt-3 xl:mt-0">
                                <input type="text" v-model="variation.name" placeholder="Variation Name" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                                <div class="mt-4">
                                  <div v-for="(option, optIndex) in variation.options" :key="optIndex" class="flex mb-2">
                                    <input type="text" v-model="option.name" placeholder="Nom Option" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 mr-2">
                                    <input type="number" v-model="option.additional_price" placeholder="Prix supplémentaire" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80">
                                    <button v-if="varIndex !== 0 || optIndex !== 0" @click="removeOption(varIndex, optIndex)" class="ml-2 bg-red-500 text-white rounded-md px-2">Supprimer</button>
                                    <!-- <button @click="removeOption(varIndex, optIndex)" class="ml-2 bg-red-500 text-white rounded-md px-2">Remove</button> -->
                                    
                                  </div>
                                  <button @click="addOption(varIndex)" class="mt-2 bg-blue-500 text-white rounded-md px-2">Ajouter Option</button>
                                </div>
                              </div>
                            </div>
  
                            <div class="mt-4">
                              <button @click="addVariation()" class="bg-blue-500 text-white rounded-md px-4 py-2">Ajouter Variation</button>
                            </div>
                          </div>
                        </div>
                      </div>
  
                      <div class="flex flex-col justify-end gap-3 mt-1 md:flex-row">
                                            <router-link to='/dashboad/products' class="transition duration-200 border shadow-sm inline-flex items-center justify-center px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&amp;:hover:not(:disabled)]:bg-secondary/20 [&amp;:hover:not(:disabled)]:dark:bg-darkmode-100/10 w-full rounded-[0.5rem] border-slate-300/80 bg-white/80 py-2.5 md:w-56"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="pen-line" class="lucide lucide-pen-line mr-2 h-4 w-4 stroke-[1.3]"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                                                Les Produits</router-link>
                                                <IsLoading v-if="isLoading" />
                                            <button  v-else type="button" @click="handleSubmit()" class="transition duration-200 border shadow-sm inline-flex items-center justify-center px-3 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary w-full rounded-[0.5rem] py-2.5 md:w-56"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="pen-line" class="lucide lucide-pen-line mr-2 h-4 w-4 stroke-[1.3]"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                                                Enregistrer</button>
                                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
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
                                      Ajout produit
                                    </div>
                                </div>
                                <div class="mt-3.5 grid grid-cols-12 gap-x-6 gap-y-7 lg:gap-y-10 xl:grid-cols-10">
                                    <div class="relative flex flex-col col-span-12 gap-y-7 lg:col-span-12 xl:col-span-12">
                                        <div class="flex flex-col p-5 box box--stacked">
                                            <div class="rounded-[0.6rem] border border-slate-200/60 p-5 dark:border-darkmode-400">
                                                <div class="flex items-center border-b border-slate-200/60 pb-5 text-[0.94rem] font-medium dark:border-darkmode-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="chevron-down" class="lucide lucide-chevron-down w-5 h-5 mr-2 stroke-[1.3]"><path d="m6 9 6 6 6-6"></path></svg>
                                                    Informations sur le produit
                                                 
                                                </div>
                                                <div class="mt-5">
                                                  
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Nom du produit</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                                            <input type="text" placeholder="Nom du produit" v-model="product.name" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Description du produit</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                                            <ckeditor :editor="editor" :config="editorConfig"
                                                            v-model="product.description"></ckeditor>
                                                        </div>
                                                    </div>
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Prix de base</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                                            <input type="number" placeholder="Prix de base" v-model="product.base_price" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Categorie</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0" v-if="categories">
                                                            <select id="category" v-model="product.category_id"   class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1">
                                                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                                                    {{ category.name }}
                                                                </option>
                                                               
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col p-5 box box--stacked">
                                            <div class="rounded-[0.6rem] border border-slate-200/80 p-5 dark:border-darkmode-400">
                                                <div class="flex items-center border-b border-slate-200/80 pb-5 text-[0.94rem] font-medium dark:border-darkmode-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="chevron-down" class="lucide lucide-chevron-down w-5 h-5 mr-2 stroke-[1.3]"><path d="m6 9 6 6 6-6"></path></svg>
                                                    Upload Produit
                                                </div>
                                                <div class="mt-5">
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Produit Photos</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                                    Des images de haute qualité peuvent considérablement
                                                                    influencer l'appeal de votre produit. Chargez des photos
                                                                    claires, bien éclairées qui montrent votre produit
                                                                    depuis différents angles et perspectives.
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                                            <div class="border border-dashed rounded-md border-slate-300/80">
                                                            <div class="grid grid-cols-9 gap-5 px-5 pt-5 sm:grid-cols-10">
                                                                <div v-for="(image, index) in imagePreviews" :key="index" class="relative h-24 col-span-3 cursor-pointer image-fit zoom-in md:col-span-2">
                                                                <img :src="image" class="rounded-lg" alt="Preview Image">
                                                                <span @click="removeImage(index)" data-placement="top" class="tooltip cursor-pointer absolute top-0 right-0 w-5 h-5 -mt-2 -mr-2 bg-white rounded-full">
                                                                    <span class="flex items-center justify-center w-full h-full text-white border rounded-full border-danger/50 bg-danger/80">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x h-4 w-4 stroke-[1.3]">
                                                                        <path d="M18 6 6 18"></path>
                                                                        <path d="m6 6 12 12"></path>
                                                                    </svg>
                                                                    </span>
                                                                </span>
                                                                </div>
                                                            </div>
                                                            <div class="relative flex items-center justify-center px-4 pb-4 mt-5 cursor-pointer">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image stroke-[1] w-4 h-4 mr-2">
                                                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                                                                <circle cx="9" cy="9" r="2"></circle>
                                                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                                                                </svg>
                                                                <span class="mr-1 text-primary">Upload les images</span>
                                                                ou glisser-déposer
                                                               
                                                                <input type="file" multiple @change="handleImageUpload" class="absolute top-0 left-0 h-full opacity-0 w-full cursor-pointer">
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col p-5 box box--stacked">
                                            <div class="rounded-[0.6rem] border border-slate-200/60 p-5 dark:border-darkmode-400">
                                            <div class="flex items-center border-b border-slate-200/60 pb-5 text-[0.94rem] font-medium dark:border-darkmode-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="chevron-down" class="lucide lucide-chevron-down w-5 h-5 mr-2 stroke-[1.3]">
                                                <path d="m6 9 6 6 6-6"></path>
                                                </svg>
                                                Détails de la Variante
                                            </div>
                                            <div class="mt-16" v-for="(variation, index) in product.variations" :key="index">
                                                <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                <div class="inline-block mb-2 mt-4 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                    <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Nom de la Variation</div>
                                                        <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                        Obligatoire
                                                        </div>
                                                    </div>
                                                    <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                        Spécifiez différentes variations de votre produit, telles que la taille, la couleur ou le style.
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="flex-1 w-full mt-3 xl:mt-0">
                                                    <input type="text" v-model="variation.name" placeholder="Nom de la variation" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                </div>
                                                </div>
                                                <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                    <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Options</div>
                                                        <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                        Obligatoire
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="flex-1 w-full mt-3 xl:mt-0">
                                                    <div v-for="(option, optionIndex) in variation.options" :key="optionIndex" class="relative py-2 pl-5 pr-5 border rounded-md border-slate-200/80 bg-slate-50/80 dark:border dark:bg-transparent xl:pr-10">
                                                    <input type="text" v-model="option.name" placeholder="Nom de l'option" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 mb-2">
                                                    <input type="number" v-model="option.additional_price" placeholder="Prix supplémentaire" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 mb-2">
                                                    <a v-if="index !== 0 || optionIndex !== 0" @click="removeOption(index, optionIndex)" class="absolute top-0 right-0 mt-8 mr-2 text-red-500 cursor-pointer">
                                                    <!-- <a @click="removeOption(index, optionIndex)" class="absolute top-0 right-0 mt-8 mr-2 text-red-500 cursor-pointer"> -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="trash2" class="lucide lucide-trash2 stroke-[1] w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                                                    </a>
                                                    </div>
                                                </div>
                                                <div class="mt-5 first:mt-0 xl:ml-20 xl:pl-5 xl:pr-20">
                                                                        <button type="button" @click="addOption(index)" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-primary text-primary dark:border-primary [&amp;:hover:not(:disabled)]:bg-primary/10 w-full border-dashed"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus mr-2 h-4 w-4 stroke-[1.3]"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                                                                            Ajouter une option</button>
                                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-2 mt-2 first:mt-0 first:pt-0 xl:ml-60 xl:pl-14">
                                                    <button type="button"  @click="addVariation" class="transition duration-200 border shadow-sm inline-flex items-center justify-center px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&amp;:hover:not(:disabled)]:bg-secondary/20 [&amp;:hover:not(:disabled)]:dark:bg-darkmode-100/10 w-full py-3 border-slate-200/80 bg-slate-50/80"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus mr-2 h-4 w-4 stroke-[1.3]"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                                                        Ajouter une variation</button>
                                                </div>
                                        </div>

                                        <div class="flex flex-col p-5 box box--stacked">
                                            <div class="rounded-[0.6rem] border border-slate-200/60 p-5 dark:border-darkmode-400">
                                                <div class="flex items-center border-b border-slate-200/60 pb-5 text-[0.94rem] font-medium dark:border-darkmode-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="chevron-down" class="lucide lucide-chevron-down w-5 h-5 mr-2 stroke-[1.3]"><path d="m6 9 6 6 6-6"></path></svg>
                                                    Gestion des produits

                                                </div>
                                                <div class="mt-5">
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Produit Status</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                                    Choisissez le statut qui reflète le mieux la disponibilité
                                                                    de ce produit pour les clients.
                                                                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                                            <div class="flex items-center"><input type="checkbox" v-model="product.status" class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;[type='radio']]:checked:bg-primary [&amp;[type='radio']]:checked:border-primary [&amp;[type='radio']]:checked:border-opacity-10 [&amp;[type='checkbox']]:checked:bg-primary [&amp;[type='checkbox']]:checked:border-primary [&amp;[type='checkbox']]:checked:border-opacity-10 [&amp;:disabled:not(:checked)]:bg-slate-100 [&amp;:disabled:not(:checked)]:cursor-not-allowed [&amp;:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&amp;:disabled:checked]:opacity-70 [&amp;:disabled:checked]:cursor-not-allowed [&amp;:disabled:checked]:dark:bg-darkmode-800/50 w-[38px] h-[24px] p-px rounded-full relative before:w-[20px] before:h-[20px] before:shadow-[1px_1px_3px_rgba(0,0,0,0.25)] before:transition-[margin-left] before:duration-200 before:ease-in-out before:absolute before:inset-y-0 before:my-auto before:rounded-full before:dark:bg-darkmode-600 checked:bg-primary checked:border-primary checked:bg-none before:checked:ml-[14px] before:checked:bg-white" id="product-status-active">
                                                                <label for="product-status-active" class="cursor-pointer ml-2">Active</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Product Stock</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                                    Entrez la quantité totale de ce produit actuellement en
                                                                   
                                                                    stock.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                                            <input id="product-stock" type="number" min="1" v-model="product.stock" placeholder="Produit en Stock" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                        </div>
                                                    </div>
                                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                        <div class="inline-block mb-2 sm:mb-0 sm:mr-5 sm:text-right xl:mr-14 xl:w-60">
                                                            <div class="text-left">
                                                                <div class="flex items-center">
                                                                    <div class="font-medium">Stock Alert</div>
                                                                    <div class="ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                                        Required
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                                    Entrez la quantité totale de ce produit pour être alerter
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                                            <input id="product-stock" type="number" min="1" v-model="product.stock_alert" placeholder="Stock alert" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                        </div>
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


<script setup>
import SideMenu from "../components/SideMenu.vue"
import { ref,onMounted } from 'vue'
import IsLoading from '../components/IsLoading.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue';


const editor = ref(ClassicEditor);
// const editorData = ref('<p>Content of the editor.</p>');
const editorConfig = ref({
    // The configuration of the editor.
});

let categories = ref({})

const product = ref({
  name: '',
  description: '',
  status: '',
  stock: '',
  stock_alert: '',
  base_price: 0,
  category_id: '',
  variations: [
  {
      name: '',
      options: [
        {
          name: '',
          additional_price: '',
        },
      ],
    },
  ],
  images: []
})

const imagePreviews = ref([])

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

const removeImage = (index) => {
  imagePreviews.value.splice(index, 1)
  product.value.images.splice(index, 1)
}


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
    } else {
      product.value.variations.push({
        name: '',
        options: [
          {
            name: '',
            additional_price: '',
          },
        ],
      })
    }
  } else {
    product.value.variations.push({
      name: '',
      options: [
        {
          name: '',
          additional_price: '',
        },
      ],
    })
  }

}



const isLoading = ref(false);

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


const removeOption = (variationIndex, optionIndex) => {
  if (product.value.variations[variationIndex].options.length === 1) {
    product.value.variations.splice(variationIndex, 1)
  } else {
    product.value.variations[variationIndex].options.splice(optionIndex, 1)
  }
 
}



const getCategories = async () => {
    const response = await axios.get('/api/get_categories')
    categories.value = response.data
    console.log('categories',response.data)
}


const handleSubmit = async () => {
    isLoading.value = true; // Activation du chargement
  try {
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
      variation.options.forEach((option, optionIndex) => {
        formData.append(`variations[${index}][options][${optionIndex}][name]`, option.name)
        formData.append(`variations[${index}][options][${optionIndex}][additional_price]`, option.additional_price)
      })
    })

    product.value.images.forEach((image, index) => {
      formData.append(`images[${index}]`, image)
    })

    await axios.post('/api/add_product', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    }).then((response) => {
        if (response.data.success) {
            isLoading.value = false; // Désactivation du chargement
            window.location.reload();
            toast.fire({
                icon: "success",
                title: "Ajouté avec succès",
            });
          
        } else {
            isLoading.value = false; // Désactivation du chargement en cas d'erreur
            console.log('error', response.data.message);
            toast.fire({
                icon: "error",
                title: "Veuillez remplir tous les champs requis",
            });
        }
    }).catch((error) => {
        isLoading.value = false; // Désactivation du chargement en cas d'erreur
        console.error('Error saving course:', error);
        toast.fire({
            icon: "error",
            title: "Une erreur s'est produite lors de la sauvegarde du cours. Veuillez réessayer plus tard.",
        });
    });
  } catch (error) {
    isLoading.value = false; // Désactivation du chargement en cas d'erreur
    console.error('Error in handleSubmit:', error);
    toast.fire({
        icon: "error",
        title: "Une erreur s'est produite lors de la soumission. Veuillez réessayer plus tard.",
    });
  }
}

onMounted (async() => {
  await  getCategories()

})

</script>
<script setup>
import { ref, onMounted } from 'vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

const form = ref({
  email: '',
  subject:'',
  name:'',
  message:'',
  number: '',
})

const isLoading = ref(false);


const shop = ref({})
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
const sendEmail = async () => {
	 isLoading.value = true; // Activation du chargement

  await axios.post('/api/send_mail',form.value).then((response) => {
    if(response.data.success){

               // router.push("/contact")
			   isLoading.value = false; // Désactivation du chargement
               window.location.reload();
               
                console.log('ok')
                  toast.fire({
                      icon: "success",
                      title: "Message envoyé avec success",
                  });

                } 
              else{
				isLoading.value = false; // Désactivation du chargement
                toast.fire({
                      icon: "error",
                      title: "Remplissez correctement tout les champs",
                  });
                console.log('errorr',response.data.message)
                errors.value = response.data.message
              }
      
  }).catch((error) => {
        isLoading.value = false; // Désactivation du chargement en cas d'erreur
        console.error('Error saving course:', error);
        toast.fire({
            icon: "error",
            title: "Une erreur s'est produite lors de la sauvegarde du cours. Veuillez réessayer plus tard.",
        });
    });

}

onMounted(async () => {
    await getShop();
});

</script>

<template>
     <Header />
     <main>
        <section class="breadcrumb-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <h1 class="page-title">Contact</h1>
                            <ul class="breadcrumb-page-list">
                                <li class="breadcrumb-item"><router-link to="/">Accueil</router-link></li>
                                <li class="breadcrumb-item">Contact </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-secton-wrapper section-space-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-us-area">
                          
                            <ul class="mt-5">
                                <li class="contact-feature-item">
                                    <div class="contact-feature-icon">
                                        <i class="icon-rt-location-pin"></i>
                                    </div>
                                    <div class="contact-feature-content">
                                        <h5 class="contact-feature-title fw-bold mb-1">
                                           Adresse
                                        </h5>
                                        <p class="text">{{ shop.address }}</p>
                                    </div>
                                </li>
                                <li class="contact-feature-item">
                                    <div class="contact-feature-icon feature-icon-2">
                                        <i class="icon-rt-phone-volume-solid"></i>
                                    </div>
                                    <div class="contact-feature-content">
                                        <h5 class="contact-feature-title fw-bold mb-1">
                                            
                                         Contact

                                        </h5>
                                        <p class="text">Pour toute urgence veuillez <br> nous contacter au: <br> {{ shop.phone }} <br>
                                           </p>
                                    </div>
                                </li>
                                <li class="contact-feature-item">
                                    <div class="contact-feature-icon feature-icon-3">
                                        <i class="icon-rt-mail-outline"></i>
                                    </div>
                                    <div class="contact-feature-content">
                                        <h5 class="contact-feature-title fw-bold mb-1">
                                            Email
                                        </h5>
                                        <p class="text">
                                            <a href="#">{{ shop.email }} </a>
                                            <br>
                                           
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="contact-us-form-wrap">
                            <form id="#contact-form" action="http://food.fga-numeriktech.com/assets/php/mail.php" method="post">
                                <div class="single-input-box">
                                    <input type="text" placeholder="Nom *" v-model="form.name" name="con_name" required="">
                                </div>
                                <div class="single-input-box">
                                    <input type="email" placeholder="Email *" v-model="form.email" name="con_email" required="">
                                </div>
                                <div class="single-input-box">
                                    <input type="text" placeholder="Tel" v-model="form.number" name="con_phone">
                                </div>
                                <div class="single-input-box">
                                    <textarea placeholder="Message *" v-model="form.message" name="con_message" required=""></textarea>
                                </div>
                                <div class="form-input" v-if="isLoading" >
														<button class="main-btn" type="button"><div  class="spinner-border text-primary" role="status">
														<span class="sr-only">Loading...</span>
													</div></button>
													</div>
                                <div class="single-input-box" v-else>
                                    <button type="button" @click="sendEmail()" class="btn btn--primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Footer class="mt-5"/>
     </main>


</template>
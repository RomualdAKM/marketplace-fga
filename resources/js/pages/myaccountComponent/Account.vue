<template>
    <div class="tab-pane fade" id="account-details" role="tabpanel">
        <h3>Modifier informations personnelles </h3>
        <div class="login">
            <div class="login-form-container">
                <div class="account-login-form">
                    <form action="#">
                        <!-- <p>{{user}} <a href="#">Log in instead!</a></p> -->
                       
                        <div class="account-input-box">
                            <label>Nom</label>
                            <input type="text"  v-model="user.name">
                            <label>Numéro</label>
                            <input type="text"  v-model="user.number">
                            <label>Email</label>
                            <input type="email"  v-model="user.email">
                         
                        </div>
                       
                        <div class="button-box">
                            <button class="btn default-btn btn btn--primary" type="button" @click="resetInfo()">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Modifier mot de passe </h3>
        <div class="login">
            <div class="login-form-container">
                <div class="account-login-form">
                    <form action="#">
                      
                       
                        <div class="account-input-box">
                           
                            <label>Ancien mot de passe</label>
                            <input type="password" name="user-password" v-model="form.old_password">
                            <label>Nouveau mot de passe</label>
                            <input type="password" name="user-password" v-model="form.password">
                            <label>Confirmer Nouveau mot de passe</label>
                            <input type="password" name="user-password" v-model="form.c_password">
                           
                        </div>
                       
                        <div class="button-box">
                            <button class="btn default-btn btn btn--primary" type="button" @click="resetPassword()">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref,reactive,onMounted} from 'vue'

const user = ref({})

const form = reactive({
    old_password: '',
    password: '',
    c_password: '',
})

const getAuthUser = async () => {
    const response = await axios.get('/api/get_auth_user_info')
    user.value = response.data
    console.log('user',response.data)
}

const isLoading = ref(false);


const resetInfo = async () => {
    isLoading.value = true; // Activation du chargement
    await axios.post("/api/reset_info_admin", user.value).then((response) => {
        if (response.data.success) {
            isLoading.value = false; // Désactivation du chargement
            //window.location.reload();
            toast.fire({
                icon: "success",
                title: "modifié avec succès",
            });
          
        } else {
            isLoading.value = false; // Désactivation du chargement en cas d'erreur
            console.log('error',response.data.message);
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
}

const resetPassword = async () => {
    isLoading.value = true; // Activation du chargement
    await axios.post("/api/reset_password", form).then((response) => {
        if (response.data.success) {
            isLoading.value = false; // Désactivation du chargement
            //window.location.reload();
            toast.fire({
                icon: "success",
                title: "mot de passe modifié avec succès",
            });
          
        } else {
            isLoading.value = false; // Désactivation du chargement en cas d'erreur
            console.log('error',response.data.message);
            toast.fire({
                icon: "error",
                title: response.data.message,
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
}

onMounted (async() => {
  await  getAuthUser()
})

</script>
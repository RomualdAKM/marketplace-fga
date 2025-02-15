<template>
    <div class="tab-pane fade" id="tab_list_07" role="tabpanel">
                                <form action="#" class="account-form-box">
                                    <div class="single-input">
                                        <label for="reg_username">Nom d'utilisateur *</label>
                                      
                                        <input type="text" name="username" v-model="form.name" id="reg_username">
                                    </div>
                                    <div class="single-input">
                                        <label for="reg_email">Adresse e-mail *</label>
                                      
                                        <input type="email" v-model="form.email" name="email address" id="reg_email">
                                    </div>
                                    <div class="single-input">
                                        <label for="reg_email">Numéro de téléphone *</label>
                                      
                                        <input type="email" v-model="form.number" name="Numéro de téléphone" id="reg_email">
                                    </div>
                                    <div class="single-input">
                                        <label for="reg_password">Mot de passe *</label>

                                        <input type="password" v-model="form.password" name="username" id="reg_password">
                                    </div>
                                    <div class="single-input">
                                        <label for="reg_password">Confirmer le mot de passe *</label>

                                        <input type="password" v-model="form.c_password" name="username" id="reg_password">
                                    </div>
                                    <!-- <p class="reg_text">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#" class="privacy-policy-link" target="_blank">privacy policy</a>.</p> -->
                                    <div class="button-box mt-25">
                                        <button type="button" @click="register()" class="btn btn--full btn--primary">S'inscrire</button>
                                     
                                    </div>
                                </form>
                            </div>
</template>
<script setup>
import { reactive, ref, onMounted } from "vue";
import router from "./../../router/index.js"

let form = reactive({
    name: "",
    email: "",
    number: "",
    password: "",
    c_password: "",
});

let errors = ref([]);


const register = async () => {
    
    await axios.post("/api/register", form).then((response) => {
        if (response.data.success) {
            sessionStorage.setItem("token", response.data.data.token);
             router.push("/");
            toast.fire({
                icon: "success",
                title: "Compte créé avec success",
            });
        } else {
          console.log('error',response.data.message)
           toast.fire({
            icon: "error",
            title: "!!!! Remplissez tout les champs et assurez vous que les passwords correspondent",
        });
        }
    });
};


</script>

<style scoped>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Assurez-vous que le conteneur prend toute la hauteur de la fenêtre */
}

.modal-content {
    width: 100%;
    max-width: 500px; /* Ajustez la largeur maximale selon vos besoins */
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.btn-close {
    position: absolute;
    top: 10px;
    right: 10px;
}

.modal-logo img {
    max-width: 100%;
    height: auto;
}

.modal-box-wrapper {
    padding: 20px;
}

.modal-tabs {
    margin-bottom: 20px;
}

.tab-content .account-form-box {
    display: flex;
    flex-direction: column;
}

.single-input {
    margin-bottom: 15px;
}

.single-input label {
    margin-bottom: 5px;
    display: block;
}

.single-input input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.checkbox-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.button-box {
    margin-top: 25px;
}

.btn--full {
    width: 100%;
    padding: 10px 0;
    text-align: center;
    display: block;
    border-radius: 5px;
    color: #fff;
    background-color: #333;
    text-decoration: none;
}
</style>

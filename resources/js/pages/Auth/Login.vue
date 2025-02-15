<template>
    <div class="tab-pane fade active show" id="tab_list_06" role="tabpanel">
        <form action="#" class="account-form-box">
            <div class="single-input">
                <label for="username">Adresse e-mail *</label>
               
                <input type="text" v-model="form.email" id="username" name="username">
            </div>
            <div class="single-input">
                <label for="password">Mot de passe *</label>
                
                <input type="password" v-model="form.password" id="password" name="password">
            </div>
            <div class="checkbox-wrap mt-10">
                <!-- <label class="label-for-checkbox inline mt-15">
                    <input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
                    <span>Remember me</span>
                </label> -->
                <router-link to="/forgot-password" class="mt-10">Mot de passe oublié ?</router-link>
            </div>
            <div class="button-box mt-25">
                <button type="button" @click="login()" class="btn btn--full btn--primary">Se connecter</button>

            </div>
        </form>
    </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import router from "./../../router/index.js"

let form = reactive({
    email: "",
    password: "",
});


const login = async () => {
    await axios.post("api/login", form).then((response) => {
        if (response.data.success) {
            sessionStorage.setItem("token", response.data.data.token);
            router.push("/");
             toast.fire({
            icon: "success",
            title: "Connexion réussie",
        });
        } else {
           toast.fire({
            icon: "error",
            title: response.data.message,
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
    height: 100vh;
    /* Assurez-vous que le conteneur prend toute la hauteur de la fenêtre */
}

.modal-content {
    width: 100%;
    max-width: 500px;
    /* Ajustez la largeur maximale selon vos besoins */
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

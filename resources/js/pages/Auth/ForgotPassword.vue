<script setup>
import { ref, reactive, onMounted } from "vue"
import router from "./../../router/index.js"

let email = reactive('')

const shop = ref('')

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

const getNewPassword = async (email) => {
    await axios.post("api/forgot_password", { email: email }).then((response) => {
        if (response.data.success) {
            router.push("/auth")
            toast.fire({
                icon: "success",
                title: "Verifier votre Email",
            });
        } else {
            toast.fire({
                icon: "error",
                title: "entrez un mail valide",
            });
            console.log('error', response.data.message)
        }
    })

}


onMounted(async () => {
    await getShop();

});
</script>


<template>
    <main>
        <section class="page-section-wrapper section-space-pb">
            <div class="container">
                <div class="modal-content">
                    <router-link to="/" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></router-link>
                    <div class="modal-logo">
                        <router-link to="/">
                            <img :src="'/storage/' + shop.logo" alt=""
                                style="width: 100px; height: 100px; border-radius: 50%;">
                        </router-link>
                    </div>
                    <div class="modal-box-wrapper">
                       
                        <div class="tab-content content-modal-box">
                            <div class="tab-pane fade active show" id="tab_list_06" role="tabpanel">
                                <form action="#" class="account-form-box">
                                    <div class="single-input">
                                        <label for="email">Adresse e-mail *</label>

                                        <input type="email" v-model="email" id="email" name="email">
                                    </div>


                                    <div class="button-box mt-25">
                                        <button type="button" @click.prevent="getNewPassword(email)"
                                            class="btn btn--full btn--primary">Valider</button>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

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

// require('./bootstrap');
import './bootstrap';
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import app from './pages/app.vue'
import router from './router/index'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.css'
import CKEditor from '@ckeditor/ckeditor5-vue';
//npm install --save @ckeditor/ckeditor5-build-classic
//npm install --save @ckeditor/ckeditor5-vue
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

window.Swal = Swal
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timeProgressBar: true,
})

window.toast = toast

const pinia = createPinia()
createApp(app).use(pinia).use(Toast).use(CKEditor).use(router).mount('#app')
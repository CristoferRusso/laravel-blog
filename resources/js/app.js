import './bootstrap';
import { createApp } from 'vue';
import App from "./components/App.vue";
import router from "./route";
import axios from 'axios';
import Toast from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { createVuetify } from 'vuetify';
import 'vuetify/styles';
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives
})

const app = createApp(App);

// Usa il plugin di notifica
app.use(Toast);

// Configura Axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

// Utilizzo del router
app.use(router);

// Utilizzo di Vuetify
app.use(vuetify);

// Monta l'app
app.mount('#app');

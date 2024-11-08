import './bootstrap';
import { createApp } from 'vue';
import App from "./components/App.vue";
import store from '../js/store';
import router from "./route";
import axios from 'axios';
import Toast from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { createVuetify } from 'vuetify';
import 'vuetify/styles';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

// Crea l'istanza di Vuetify
const vuetify = createVuetify({
    components,
    directives
});

const app = createApp(App);

// Usa il plugin di notifica
app.use(Toast);
app.use(store);

// Imposta l'URL di base per le richieste (modifica con il tuo URL)
axios.defaults.baseURL = 'http://localhost:8000/';  // Cambia con l'URL del tuo server API

// Imposta 'withCredentials' su true per includere i cookie in tutte le richieste
axios.defaults.withCredentials = true;

// Configura Axios per gestire il token CSRF
// Se hai un meta tag che contiene il token CSRF nel tuo layout HTML:
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content;
}

// Usa Axios globalmente (accesso tramite app.config.globalProperties)
app.config.globalProperties.$axios = axios;

// Configura il router
app.use(router);

// Configura Vuetify
app.use(vuetify);

// Monta l'app
app.mount('#app');

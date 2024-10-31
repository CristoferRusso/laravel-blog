import './bootstrap';
import { createApp } from 'vue'; // Importa createApp
import { createRouter, createWebHistory } from 'vue-router'; // Importa createRouter e createWebHistory
import Vuetest from './components/Vuetest.vue';

// Configurazione delle rotte
const routes = [
  { path: '/app', component: Vuetest }, 
];

// Crea un'istanza del router
const router = createRouter({
  history: createWebHistory(), // Usa createWebHistory
  routes
});

// Crea l'istanza dell'app Vue e monta con il router
const app = createApp(Vuetest); // Crea l'app utilizzando Vuetest come componente principale
app.use(router); // Usa il router
app.mount('#app'); // Monta l'app

import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import Calendar from './components/Calendar.vue';
import Login from './components/Login.vue';
import Setting from './components/Setting.vue';

const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/calendar', component: Calendar, name: 'Calendar' },
    { path: '/setting', component: Setting, name: 'Setting' },
    { path: '/login', component: Login, name: 'Login' },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

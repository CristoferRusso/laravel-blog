<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">JOB CALENDAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <router-link class="nav-link fw-semibold" to="/">Home</router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link class="nav-link fw-semibold" to="/calendar">Calendario</router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link class="nav-link fw-semibold" to="/setting">Impostazioni</router-link>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link class="nav-link fw-semibold" to="/login">Login</router-link>
                    </li>
                    <li class="nav-item " v-if="isLoggedIn">
                        <button @click="logout" class="btn btn-link nav-link fw-semibold">Logout</button>
                    </li>
                    <li class="nav-item">
                        <span class="fw-semibold">{{ user }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            isLoggedIn: false,
            user: null
        };
    },
    created() {
        this.checkAuth();
    },
    methods: {
        async checkAuth() {
            try {
                const token = localStorage.getItem('auth_token');
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

                const response = await axios.get('api/profile');
                if (response.data && response.data.name) {
                    this.isLoggedIn = true;
                    this.user = response.data.name;
                } else {
                    this.isLoggedIn = false;
                    this.user = null;
                }
            } catch (error) {
                console.error("Error checking auth:", error);
                this.isLoggedIn = false;
                this.user = null;
            }
        },

        async logout() {
            const response = await axios.post('/api/logout');
            console.log(response.data);
            this.isLoggedIn = false;
            this.$router.push('/login');
        },
    },
};
</script>

<style scoped>
</style>

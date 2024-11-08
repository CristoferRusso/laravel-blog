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
                    <li class="nav-item" v-if="isAuthenticated">
                        <router-link class="nav-link fw-semibold" to="/calendar">Calendario</router-link>
                    </li>
                    <li class="nav-item" v-if="isAuthenticated">
                        <router-link class="nav-link fw-semibold" to="/setting">Impostazioni</router-link>
                    </li>
                    <li class="nav-item" v-if="!isAuthenticated">
                        <router-link class="nav-link fw-semibold" to="/login">Login</router-link>
                    </li>
                    <li class="nav-item " v-if="isAuthenticated">
                        <button @click="logout" class="btn btn-link nav-link fw-semibold">Logout</button>
                    </li>
                    <li class="nav-item">
                        <span class="fw-semibold" v-if="getUser">{{ getUser }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    computed: {
        ...mapGetters('auth', ['isAuthenticated', "getUser"]),
    },
    methods: {
        ...mapActions('auth', ['logout']),
    },
    mounted() {
        this.$store.dispatch('auth/checkAuth');
    }
};
</script>

<style scoped>
</style>

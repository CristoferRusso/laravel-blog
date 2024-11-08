<template>
    <v-container class="mt-5">
        <!-- Login Form -->
        <v-row v-if="!isRegistering" justify="center">
            <v-col cols="12" md="6">
                <v-card>
                    <v-card-title class="text-center">
                        <h3>Login</h3>
                    </v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="loginUser" lazy-validation>
                            <v-text-field
                                label="Email"
                                v-model="loginForm.email"
                                :rules="[v => !!v || 'Email è obbligatoria', v => /.+@.+\..+/.test(v) || 'Email non valida']"
                                type="email"
                                required
                                outlined
                                clearable
                                autocomplete="email"
                            ></v-text-field>
                            <v-text-field
                                label="Password"
                                v-model="loginForm.password"
                                :rules="[v => !!v || 'Password è obbligatoria']"
                                type="password"
                                required
                                outlined
                                clearable
                                autocomplete="current-password"
                            ></v-text-field>
                            <v-btn color="primary" class="w-100" type="submit">
                                Login
                            </v-btn>
                        </v-form>
                        <div class="text-center mt-3">
                            <p>Non hai un account?
                                <v-btn small @click="toggleView">Registrati qui</v-btn>
                            </p>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <!-- Register Form -->
        <v-row v-if="isRegistering" justify="center">
            <v-col cols="12" md="6">
                <v-card>
                    <v-card-title class="text-center">
                        <h3>Registrazione</h3>
                    </v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="registerUser">
                            <v-text-field
                                label="Nome"
                                v-model="registerForm.name"
                                required
                                outlined
                                clearable
                            ></v-text-field>
                            <v-text-field
                                label="Email"
                                v-model="registerForm.email"
                                type="email"
                                required
                                outlined
                                clearable
                            ></v-text-field>
                            <v-text-field
                                label="Password"
                                v-model="registerForm.password"
                                type="password"
                                required
                                outlined
                                clearable
                            ></v-text-field>
                            <v-text-field
                                label="Conferma password"
                                v-model="registerForm.password_confirmation"
                                type="password"
                                required
                                outlined
                                clearable
                            ></v-text-field>
                            <v-btn color="primary" class="w-100" type="submit">
                                Registrati
                            </v-btn>
                        </v-form>
                        <div class="text-center mt-3">
                            <p>Hai già un account?
                                <v-btn small @click="toggleView">Login qui</v-btn>
                            </p>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { ref } from 'vue';
import { useStore } from 'vuex';

export default {
    data() {
        return {
            isRegistering: false,
        };
    },
    methods: {
        toggleView() {
            this.isRegistering = !this.isRegistering;
        }
    },
    setup() {
        const store = useStore(); // Ottieni l'istanza dello store

        const loginForm = ref({
            email: '',
            password: '',
        });
        const registerForm = ref({
            email: '',
            password: '',
            password_confirmation: ''
        });

        const loginUser = async () => {
            try {
                await store.dispatch('auth/login', loginForm.value); // Usa store.dispatch
            } catch (error) {
                console.error("Errore durante il login:", error);
            }
        };

        const registerUser = async () => {
            try {
                await store.dispatch('auth/register', registerForm.value); // Usa store.dispatch
            } catch (error) {
                console.error("Errore durante la registrazione:", error);
            }
        };

        return {
            loginForm,
            registerForm,
            loginUser,
            registerUser,
        };
    },
};

</script>

<style scoped>

</style>

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
                        <v-form @submit.prevent="login" v-model="valid" lazy-validation>
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
                            <v-btn color="primary" class="w-100"  type="submit">
                                Login
                            </v-btn>
                        </v-form>
                        <div class="text-center mt-3">
                            <p>Non hai un account?
                                <v-btn  small @click="toggleView">Registrati qui</v-btn>
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
                        <v-form @submit.prevent="register">
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
                                <v-btn  small @click="toggleView">Login qui</v-btn>
                            </p>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            isRegistering: false,
            valid: true,
            loginForm: {
                email: '',
                password: '',
            },
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
        };
    },
    methods: {
        toggleView() {
            this.isRegistering = !this.isRegistering;
        },
        async login() {
            try {
                const response = await axios.post('api/login', this.loginForm);
                this.token = response.data.token;
                localStorage.setItem('auth_token', this.token);
                this.$router.push('/calendar');
            } catch (error) {
                this.$toast.error('Credenziali di login non valide!');
            }
        },
        async register() {
            try {
                const response = await axios.post('api/register', this.registerForm);
                console.log('Registration successful:', response.data);
                this.toggleView();
            } catch (error) {
                console.error('Registration error:', error.response.data);
            }
        },
    },
};
</script>

<style scoped>

</style>

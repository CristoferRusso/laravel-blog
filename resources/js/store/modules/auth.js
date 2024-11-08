import axios from '../../api/axios';
import router from "@/route";

export const auth = {
    namespaced: true,
    state: () => ({
        isLoggedIn: !!localStorage.getItem('auth_token'),
        user: null,
    }),
    getters: {
        isAuthenticated(state) {
            return state.isLoggedIn;
        },
        getUser(state) {
            return state.user && state.user.name;
        },
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
            state.isLoggedIn = !!user;
        },
        clearUser(state) {
            state.user = null;
            state.isLoggedIn = false;
        },
    },
    actions: {
        async login({ commit }, credentials) {
            try {
                const response = await axios.post('/api/login', credentials);
                const token = response.data.token;

                localStorage.setItem('auth_token', token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

                const profileResponse = await axios.get('/api/profile');
                commit('setUser', profileResponse.data.user);
                await router.push('/calendar')
            } catch (error) {
                console.error('Login failed:', error);
            }
        },
        async register({},credentials) {
            await axios.post('/api/register', credentials);
        },
        async logout({ commit }) {
            await axios.post('/api/logout');
            localStorage.removeItem('auth_token');
            delete axios.defaults.headers.common['Authorization'];

            commit('clearUser');
            await router.push('/login')

        },
        async checkAuth({ commit }) {
            try {
                const profileResponse = await axios.get('/api/profile');
                commit('setUser', profileResponse.data.user);
            } catch {
                commit('clearUser');
            }
        },
    }
};

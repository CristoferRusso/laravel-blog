import axios from 'axios';

// Controlla se c'è un token nel localStorage e impostalo come header per tutte le richieste
const token = localStorage.getItem('auth_token');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export default axios;

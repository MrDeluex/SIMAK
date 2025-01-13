import axios from 'axios';

const api = axios.create({
    baseURL: 'http://127.0.0.1:8080/api', // URL API Laravel
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}` // Menambahkan Authorization di sini
    },
});
export default api;
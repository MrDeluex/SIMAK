<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="handleLogin">
      <input v-model="email" type="email" placeholder="Email" />
      <input v-model="password" type="password" placeholder="Password" />
      <button type="submit">Login</button>
    </form>
    <p v-if="error">{{ error }}</p>
  </div>
</template>

<script>
import api from '../api/api';

export default {
  data() {
    return {
      email: '',
      password: '',
      error: null,
    };
  },
  methods: {
    handleLogin() {
      api.post('/login', { email: this.email, password: this.password })
        .then(response => {
          console.log('Login berhasil:', response.data);
          // Tambahkan logika setelah login berhasil
        })
        .catch(error => {
          console.error('Login gagal:', error.message);
          this.error = 'Login gagal. Silakan coba lagi.';
        });
    },
  },
};
</script>

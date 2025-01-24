<template>
  <div class="app">
    <nav class="navbar">
      <div class="nav-content">
        <router-link to="/" class="logo">
        </router-link>
      </div>
    </nav>

    <main class="main">
      <UrlShortener />
    </main>

    <footer class="footer">
      <div class="footer-content">
        © {{ new Date().getFullYear() }} URL Shortener
      </div>
    </footer>
  </div>
</template>

<script>
import UrlShortener from './views/UrlShortener.vue'

export default {
  name: 'App',
  components: {
    UrlShortener
  }
}
</script>
<style>
/* Глобальные стили */
:root {
  --primary-color: #3B82F6;
  --text-color: #1F2937;
  --bg-color: #F3F4F6;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
    Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  background-color: var(--bg-color);
  color: var(--text-color);
  line-height: 1.5;
}

.app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.navbar, .footer {
  background-color: white;
  padding: 20px;
  height: 60px;   
  display: flex;
  align-items: center;
}

.nav-content, .footer-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  width: 100%;
  display: flex;
  align-items: center;
}

.logo {
  font-size: 20px;
  font-weight: 600;
  color: var(--primary-color);
  text-decoration: none;
}

.main {
  flex: 1;
  padding: 20px;
}

.footer {
  text-align: center;
}

.footer-content {
  justify-content: center;
}

@media (max-width: 640px) {
  .nav-content,
  .footer-content {
    padding: 16px;
  }
}
</style> 

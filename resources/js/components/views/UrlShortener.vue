<template>
  <div class="url-shortener">
    <h1 class="title">URL Shortener</h1>
    <div class="content">
      <UrlForm @url-created="handleUrlCreated" />
      <UrlResult 
        v-if="shortUrl" 
        :shortUrl="shortUrl"
        :originalUrl="originalUrl"
        :clickCount="clickCount"
        @update-click-count="clickCount = $event"
      />
    </div>
  </div>
</template>

<script>
import UrlForm from '../url/UrlForm.vue'
import UrlResult from '../url/UrlResult.vue'

export default {
  name: 'UrlShortener',
  components: {
    UrlForm,
    UrlResult
  },
  data() {
    return {
      shortUrl: '',
      originalUrl: '',
      clickCount: 0
    }
  },
  methods: {
    handleUrlCreated(shortUrl, originalUrl, clickCount) {
      this.shortUrl = shortUrl;
      this.originalUrl = originalUrl;
      this.clickCount = clickCount;
    }
  }
}
</script>

<style scoped>
.url-shortener {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  width: 100%;
}

.title {
  font-size: 32px;
  font-weight: 600;
  color: var(--primary-color);
  text-align: center;
  margin-bottom: 32px;
}

.content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 24px;
  width: 100%;
}
</style> 
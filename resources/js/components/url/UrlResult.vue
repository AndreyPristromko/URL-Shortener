<template>
  <div v-if="shortUrl" class="result-container">
    <div class="result-header">
      Ваша короткая ссылка готова:
    </div>
    
    <div class="url-display">
      <div class="url-wrapper">
        <a :href="shortUrl" target="_blank" class="short-url">
          {{ shortUrl }}
        </a>
      </div>
      
      <AppButton 
        variant="secondary"
        @click="copyToClipboard"
        :disabled="copied"
      >
        {{ copied ? 'Скопировано!' : 'Копировать' }}
      </AppButton>
    </div>

    <div class="original-url" v-if="originalUrl">
      Оригинальная ссылка: 
      <a :href="originalUrl" target="_blank" class="url-link">
        {{ originalUrl }}
      </a>
    </div>

    <div class="click-count">
      Количество переходов: {{ clickCount }}
    </div>
  </div>
</template>

<script>
import AppButton from '../common/AppButton.vue'
import axios from 'axios'

export default {
  name: 'UrlResult',
  components: {
    AppButton
  },

  props: {
    shortUrl: {
      type: String,
      required: true
    },
    originalUrl: {
      type: String,
      required: true
    },
    clickCount: {
      type: Number,
      default: 0
    }
  },

  data() {
    return {
      copied: false,
      updateInterval: null
    }
  },

  methods: {
    async copyToClipboard() {
      try {
        await navigator.clipboard.writeText(this.shortUrl)
        this.copied = true
        
        setTimeout(() => {
          this.copied = false
        }, 2000)
      } catch (err) {
        console.error('Ошибка при копировании:', err)
      }
    },
    async updateClickCount() {
      try {
        const response = await axios.get(`/url/clicks/${this.shortUrl.split('/').pop()}`);
        this.$emit('update-click-count', response.data.click_count);
      } catch (err) {
        console.error('Ошибка при обновлении счетчика кликов:', err);
      }
    }
  },

  mounted() {
    // Обновляем счетчик каждые 5 секунд
    this.updateInterval = setInterval(this.updateClickCount, 5000);
  },

  beforeUnmount() {
    // Очищаем интервал при удалении компонента
    clearInterval(this.updateInterval);
  }
}
</script>

<style scoped>
.result-container {
  width: 500px; 
  background-color: #F3F4F6;
  border-radius: 8px;
  padding: 16px;
}

.result-header {
  font-size: 18px;
  font-weight: 500;
  color: #374151;
  margin-bottom: 12px;
}

.url-display {
  width: 100%;
  display: flex;
  align-items: center;
  background-color: white;
  padding: 12px;
  border-radius: 6px;
  margin-bottom: 12px;
}

.url-wrapper {
  flex-grow: 1;
  margin-right: 12px;
}

.short-url {
  display: block;
  width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
}

.original-url {
  font-size: 14px;
  color: #6B7280;
}

.url-link {
  color: #6B7280;
  text-decoration: none;
  word-break: break-all;
}

.url-link:hover {
  text-decoration: underline;
}

.click-count {
  font-size: 14px;
  color: #6B7280;
  margin-bottom: 12px;
}
</style> 
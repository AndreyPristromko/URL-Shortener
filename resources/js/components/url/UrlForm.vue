<template>
  <form @submit.prevent="handleSubmit" class="url-form">
    <AppInput
      id="url-input"
      v-model="url"
      label="Введите URL для сокращения"
      placeholder="https://example.com"
      type="url"
      :error="error"
    />
    
    <AppButton 
      type="submit"
      :loading="loading"
      class="submit-button"
    >
      Сократить
    </AppButton>
  </form>
</template>

<script>
import AppInput from '../common/AppInput.vue'
import AppButton from '../common/AppButton.vue'
import axios from 'axios'

export default {
  name: 'UrlForm',
  components: {
    AppInput,
    AppButton
  },
  
  data() {
    return {
      url: '',
      loading: false,
      error: ''
    }
  },

  methods: {
    async handleSubmit() {
      if (!this.url) {
        this.error = 'Пожалуйста, введите URL'
        return
      }

      this.loading = true
      this.error = ''

      try {
        const response = await axios.post('/url/create', {
          url: this.url
        });

        this.$emit('url-created', response.data.short_url, this.url, response.data.click_count);
        this.url = ''
      } catch (err) {
        this.error = 'Ошибка при создании короткой ссылки'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
.url-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  max-width: 500px;
  width: 100%;
}

.submit-button {
  align-self: flex-start;
}
</style> 
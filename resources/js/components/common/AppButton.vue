<template>
  <button
    :type="type"
    class="button"
    :class="[`button-${variant}`, { 'button-loading': loading }]"
    :disabled="disabled || loading"
    @click="$emit('click')"
  >
    <!-- Индикатор загрузки -->
    <span v-if="loading" class="loader"></span>
    
    <!-- Основной текст кнопки -->
    <span :class="{ 'invisible': loading }">
      <slot></slot>
    </span>
  </button>
</template>

<script>
export default {
  name: 'AppButton',
  props: {
    variant: {
      type: String,
      default: 'primary',
      validator: value => ['primary', 'secondary', 'danger'].includes(value)
    },
    type: {
      type: String,
      default: 'button'
    },
    loading: {
      type: Boolean,
      default: false
    },
    disabled: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style scoped>
.button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  min-width: 100px;
  border: none;
}

.button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Варианты кнопок */
.button-primary {
  background-color: #3B82F6;
  color: white;
}

.button-primary:hover:not(:disabled) {
  background-color: #2563EB;
}

.button-secondary {
  background-color: #E5E7EB;
  color: #374151;
}

.button-secondary:hover:not(:disabled) {
  background-color: #D1D5DB;
}

.button-danger {
  background-color: #EF4444;
  color: white;
}

.button-danger:hover:not(:disabled) {
  background-color: #DC2626;
}

/* Лоадер */
.loader {
  width: 16px;
  height: 16px;
  border: 2px solid #FFF;
  border-bottom-color: transparent;
  border-radius: 50%;
  animation: rotation 1s linear infinite;
  position: absolute;
}

@keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

.invisible {
  visibility: hidden;
}
</style> 
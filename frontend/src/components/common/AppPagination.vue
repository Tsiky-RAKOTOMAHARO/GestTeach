<script setup>
const props = defineProps({
  currentPage: {
    type: Number,
    required: true
  },
  totalPages: {
    type: Number,
    required: true
  }
})

const emit = defineEmits(['change'])

function aller(page) {
  if (page < 1 || page > props.totalPages) return
  emit('change', page)
}

function pages() {
  const result = []
  for (let i = 1; i <= props.totalPages; i++) result.push(i)
  return result
}
</script>

<template>
  <div v-if="totalPages > 1" class="pagination">

    <button class="page-btn" :disabled="currentPage === 1" @click="aller(currentPage - 1)">
      ‹
    </button>

    <button
      v-for="page in pages()"
      :key="page"
      class="page-btn"
      :class="{ active: page === currentPage }"
      @click="aller(page)"
    >
      {{ page }}
    </button>

    <button class="page-btn" :disabled="currentPage === totalPages" @click="aller(currentPage + 1)">
      ›
    </button>

  </div>
</template>

<style scoped>
.pagination {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  padding-top: var(--space-4);
}

.page-btn {
  min-width: 32px;
  height: 32px;
  padding: 0 var(--space-2);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-md);
  background: var(--color-surface-card);
  color: var(--color-text-secondary);
  font-size: var(--text-md);
  font-family: var(--font-mono);
  font-weight: 500;
  cursor: pointer;
  transition: background 0.15s, color 0.15s, border-color 0.15s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.page-btn:hover:not(:disabled) {
  background: var(--color-primary-50);
  color: var(--color-primary-600);
  border-color: var(--color-primary-400);
}

.page-btn.active {
  background: var(--color-primary-600);
  color: var(--color-text-inverse);
  border-color: var(--color-primary-600);
  font-weight: 700;
}

.page-btn:disabled {
  opacity: 0.35;
  cursor: not-allowed;
}
</style>
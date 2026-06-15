<script setup>
import { onMounted } from 'vue'
import { useEnseignantStore } from '../store/enseignants'
import EnseignantTable from '../components/enseignant/EnseignantTable.vue'

const store = useEnseignantStore()

onMounted(async () => {
  await store.chargerEnseignants()
})
</script>

<template>
  <div class="list-content">

    <div class="list-header">
      <h1 class="list-title">Liste des Enseignants</h1>
    </div>

    <EnseignantTable />

  </div>
</template>

<style scoped>
.list-content {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.list-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.list-title {
  font-size: var(--text-display);
  font-weight: 700;
  color: var(--color-text-primary);
}

.store-message {
  font-size: var(--text-md);
  color: var(--color-primary-600);
  background: var(--color-primary-50);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-md);
  padding: var(--space-3) var(--space-4);
}
</style>
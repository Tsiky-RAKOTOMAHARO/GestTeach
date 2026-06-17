<script setup>
import { computed } from 'vue'
import { useEnseignantStore } from '@/store/enseignants'

const store = useEnseignantStore()

const totalEnseignants = computed(() => store.enseignants.length)

const totalMasse = computed(() =>
  store.enseignants.reduce((sum, e) => sum + e.tauxHoraire * e.nombreHeure, 0)
)

const totalHeures = computed(() =>
  store.enseignants.reduce((sum, e) => sum + (Number(e.nombreHeure) || 0), 0)
)

const moyenneTaux = computed(() => {
  if (!store.enseignants.length) return 0
  const total = store.enseignants.reduce((sum, e) => sum + e.tauxHoraire, 0)
  return (total / store.enseignants.length).toFixed(2)
})
</script>

<template>
  <div class="metrics-grid">

    <div class="metric-card">
      <span class="metric-icon"></span>
      <div class="metric-body">
        <p class="metric-label">Total Enseignants</p>
        <p class="metric-value" style="color: var(--color-primary-400);">{{ totalEnseignants }}</p>
      </div>
    </div>

    <div class="metric-card">
      <span class="metric-icon"></span>
      <div class="metric-body">
        <p class="metric-label">Prestation Total</p>
        <p class="metric-value" style="color: #059669;">{{ totalMasse.toLocaleString() }}</p>
      </div>
    </div>

    <div class="metric-card">
      <span class="metric-icon"></span>
      <div class="metric-body">
        <p class="metric-label">Salaire Maximum</p>
        <p class="metric-value" style="color: #7c3aed;">{{ totalHeures }}</p>
      </div>
    </div>

    <div class="metric-card">
      <span class="metric-icon"></span>
      <div class="metric-body">
        <p class="metric-label">Salaire Minimum</p>
        <p class="metric-value">{{ totalEnseignants}}</p>
      </div>
    </div> 

  </div>
</template>

<style scoped>
.metrics-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-4);
}

.metric-card {
  background: var(--color-surface-card);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-xl);
  padding: var(--space-5);
  display: flex;
  align-items: center;
  gap: var(--space-4);
  transition: box-shadow 0.15s;
}

.metric-card:hover {
  box-shadow: 0 4px 20px rgba(83, 74, 183, 0.08);
}


.metric-body {
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
}

.metric-label {
  font-size: var(--text-sm);
  color: var(--color-text-tertiary);
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.metric-value {
  font-size: var(--text-display);
  font-weight: 700;
  color: var(--color-primary-600);
}
</style>
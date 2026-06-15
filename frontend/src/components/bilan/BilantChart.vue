<script setup>
import { computed } from 'vue'
import { useEnseignantStore } from '@/store/enseignants'

const store = useEnseignantStore()

const maxTotal = computed(() =>
  Math.max(...store.enseignants.map(e => e.tauxHoraire * e.nombreHeure), 1)
)

const barData = computed(() =>
  store.enseignants.map(e => ({
    label: `${e.nom}`,
    total: e.tauxHoraire * e.nombreHeure,
    heures: e.nombreHeure,
    pct: ((e.tauxHoraire * e.nombreHeure) / maxTotal.value) * 100
  }))
)
</script>

<template>
  <div class="chart-card">
    <h3 class="card-title">Total à payer par enseignant</h3>

    <div class="chart-body">
      <div v-for="bar in barData" :key="bar.label" class="bar-row">
        <span class="bar-label">{{ bar.label }}</span>
        <div class="bar-track">
          <div class="bar-fill" :style="{ width: bar.pct + '%' }"></div>
        </div>
        <span class="bar-value">{{ bar.total.toLocaleString() }}</span>
      </div>
    </div>

  </div>
</template>

<style scoped>
.chart-card {
  background: var(--color-surface-card);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-xl);
  padding: var(--space-6);
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.card-title {
  font-size: var(--text-xl);
  font-weight: 600;
  color: var(--color-text-primary);
  padding-bottom: var(--space-4);
  border-bottom: 1px solid var(--color-surface-border);
}

.chart-body {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.bar-row {
  display: flex;
  align-items: center;
  gap: var(--space-4);
}

.bar-label {
  width: 80px;
  font-size: var(--text-md);
  font-weight: 500;
  color: var(--color-text-secondary);
  flex-shrink: 0;
  text-align: right;
}

.bar-track {
  flex: 1;
  height: 10px;
  background: var(--color-surface-subtle);
  border-radius: var(--radius-full);
  overflow: hidden;
}

.bar-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--color-primary-400), var(--color-primary-600));
  border-radius: var(--radius-full);
  transition: width 0.4s ease;
}

.bar-value {
  width: 80px;
  font-size: var(--text-md);
  font-weight: 700;
  color: var(--color-primary-600);
  flex-shrink: 0;
}
</style>
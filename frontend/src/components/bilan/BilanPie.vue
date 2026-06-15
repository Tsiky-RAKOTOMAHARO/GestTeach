<script setup>
import { computed } from 'vue'
import { useEnseignantStore } from '@/store/enseignants'

const store = useEnseignantStore()

const totalMasse = computed(() =>
  store.enseignants.reduce((sum, e) => sum + e.tauxHoraire * e.nombreHeure, 0)
)

const slices = computed(() => {
  const colors = [
  '#6366f1', // indigo
  '#059669', // emerald
  '#7c3aed', // violet
  '#0ea5e9', // sky
  '#f59e0b', // amber
  '#ec4899', // pink
  '#14b8a6', // teal
  '#f97316', // orange
  ]
  let startAngle = 0
  return store.enseignants.map((e, i) => {
    const total = e.tauxHoraire * e.nombreHeure
    const pct = totalMasse.value ? total / totalMasse.value : 0
    const angle = pct * 360
    const slice = { ...e, total, pct, startAngle, angle, color: colors[i % colors.length] }
    startAngle += angle
    return slice
  })
})

function describeArc(cx, cy, r, startAngle, endAngle) {
  const toRad = (deg) => (deg - 90) * Math.PI / 180
  const x1 = cx + r * Math.cos(toRad(startAngle))
  const y1 = cy + r * Math.sin(toRad(startAngle))
  const x2 = cx + r * Math.cos(toRad(endAngle))
  const y2 = cy + r * Math.sin(toRad(endAngle))
  const large = endAngle - startAngle > 180 ? 1 : 0
  return `M ${cx} ${cy} L ${x1} ${y1} A ${r} ${r} 0 ${large} 1 ${x2} ${y2} Z`
}
</script>

<template>
  <div class="pie-card">
    <h3 class="card-title">Répartition de la masse salariale</h3>

    <div class="pie-body">
      <svg viewBox="0 0 200 200" class="pie-svg">
        <path
          v-for="slice in slices"
          :key="slice.matricule"
          :d="describeArc(100, 100, 90, slice.startAngle, slice.startAngle + slice.angle)"
          :fill="slice.color"
          stroke="white"
          stroke-width="2"
        />
        <circle cx="100" cy="100" r="50" fill="white" />
        <text x="100" y="96" text-anchor="middle" font-size="10" fill="#5C5673">Total</text>
        <text x="100" y="112" text-anchor="middle" font-size="11" font-weight="bold" fill="#1A1628">
          {{ totalMasse.toLocaleString() }}
        </text>
      </svg>

      <div class="pie-legend">
        <div v-for="slice in slices" :key="slice.matricule" class="legend-item">
          <span class="legend-dot" :style="{ background: slice.color }"></span>
          <span class="legend-name">{{ slice.nom }} {{ slice.prenom }}</span>
          <span class="legend-pct">{{ (slice.pct * 100).toFixed(1) }}%</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.pie-card {
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

.pie-body {
  display: flex;
  align-items: center;
  gap: var(--space-6);
}

.pie-svg {
  width: 200px;
  height: 200px;
  flex-shrink: 0;
}

.pie-legend {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
  flex: 1;
}

.legend-item {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.legend-dot {
  width: 12px;
  height: 12px;
  border-radius: var(--radius-full);
  flex-shrink: 0;
}

.legend-name {
  flex: 1;
  font-size: var(--text-md);
  color: var(--color-text-secondary);
}

.legend-pct {
  font-size: var(--text-md);
  font-weight: 600;
  color: var(--color-primary-600);
}
</style>
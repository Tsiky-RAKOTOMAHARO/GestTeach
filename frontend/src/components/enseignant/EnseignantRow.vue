<script setup>
defineProps({
  enseignant: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['editer', 'supprimer'])
</script>

<template>
  <tr>
    <td>
      <span class="matricule-badge">{{ enseignant.matricule }}</span>
    </td>
    <td class="text-primary">{{ enseignant.nom }}</td>
    <td class="text-secondary">{{ enseignant.prenom }}</td>
    <td class="text-secondary">{{ enseignant.tauxHoraire }}</td>
    <td class="text-secondary">{{ enseignant.nombreHeure }}</td>
    <td>
      <strong class="total">{{ enseignant.tauxHoraire * enseignant.nombreHeure }}</strong>
    </td>
    <td>
      <div class="action-group">
        <button class="btn-edit" @click="emit('editer', enseignant)">Modifier</button>
        <button class="btn-delete" @click="emit('supprimer', enseignant.matricule)">Supprimer</button>
      </div>
    </td>
  </tr>
</template>

<style scoped>

td {
  padding: 16px 28px;
  color: var(--color-text-primary);
}

.matricule-badge {
  display: inline-block;
  padding: var(--space-1) var(--space-3);
  background: var(--color-primary-50);
  color: var(--color-primary-800);
  border-radius: var(--radius-full);
  font-size: var(--text-sm);
  font-weight: 600;
}

.text-primary {
  color: var(--color-text-primary);
  font-weight: 500;
}

.text-secondary {
  color: var(--color-text-secondary);
}

.total {
  color: var(--color-primary-600);
  font-weight: 700;
}

.action-group {
  display: flex;
  gap: var(--space-2);
}

.btn-edit,
.btn-delete {
  padding: var(--space-1) var(--space-3);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--text-sm);
  font-family: var(--font-mono);
  font-weight: 500;
  cursor: pointer;
  transition: background 0.15s, color 0.15s;
}

.btn-edit {
  background: var(--color-primary-50);
  color: var(--color-primary-600);
}

.btn-edit:hover {
  background: var(--color-primary-400);
  color: var(--color-text-inverse);
}

.btn-delete {
  background: #FEF2F2;
  color: #DC2626;
}

.btn-delete:hover {
  background: #DC2626;
  color: #FFFFFF;
}
</style>
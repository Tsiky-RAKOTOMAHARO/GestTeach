<script setup>
defineProps({
  itemIdentifier: {
    type: [String, Number],
    required: true
  }
})
defineEmits(['confirm', 'cancel'])
</script>

<template>
  <div class="delete-confirm">

    <div class="confirm-header">
      <span class="confirm-icon"></span>
      <h3 class="confirm-title">Confirmation de suppression</h3>
    </div>

    <div class="confirm-body">
      <p class="confirm-message">
        Êtes-vous sûr de vouloir supprimer l'enseignant avec le matricule
        <span class="matricule-badge">{{ itemIdentifier }}</span> ?
      </p>
      <p class="confirm-warning">Cette action est irréversible.</p>
    </div>

    <div class="confirm-actions">
      <button class="btn-secondary" @click="$emit('cancel')">Annuler</button>
      <button class="btn-danger" @click="$emit('confirm')">Confirmer la suppression</button>
    </div>

  </div>
</template>

<style scoped>
.delete-confirm {
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.confirm-header {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding-bottom: var(--space-4);
  border-bottom: 1px solid var(--color-surface-border);
}

.confirm-icon {
  font-size: 22px;
}

.confirm-title {
  font-size: var(--text-xl);
  font-weight: 600;
  color: #DC2626;
}

.confirm-body {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.confirm-message {
  font-size: var(--text-md);
  color: var(--color-text-primary);
  line-height: 1.6;
}

.matricule-badge {
  display: inline-block;
  padding: var(--space-1) var(--space-3);
  background: var(--color-primary-50);
  color: var(--color-primary-800);
  border-radius: var(--radius-full);
  font-size: var(--text-sm);
  font-weight: 700;
}

.confirm-warning {
  font-size: var(--text-sm);
  color: #DC2626;
  background: #FEF2F2;
  border: 1px solid #FECACA;
  border-radius: var(--radius-md);
  padding: var(--space-2) var(--space-3);
}

.confirm-actions {
  display: flex;
  justify-content: flex-end;
  gap: var(--space-3);
  padding-top: var(--space-4);
  border-top: 1px solid var(--color-surface-border);
}

.btn-secondary {
  padding: var(--space-3) var(--space-5);
  background: transparent;
  color: var(--color-text-secondary);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-md);
  font-size: var(--text-md);
  font-family: var(--font-mono);
  font-weight: 500;
  cursor: pointer;
  transition: background 0.15s, color 0.15s;
}

.btn-secondary:hover {
  background: var(--color-surface-subtle);
  color: var(--color-text-primary);
}

.btn-danger {
  padding: var(--space-3) var(--space-5);
  background: #DC2626;
  color: #FFFFFF;
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--text-md);
  font-family: var(--font-mono);
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s;
}

.btn-danger:hover {
  background: #B91C1C;
}
</style>
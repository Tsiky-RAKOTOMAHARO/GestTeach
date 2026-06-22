<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  modelValue: {
    type: Object,
    default: null
  },
  isEdit: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['update:modelValue', 'sauvegarder', 'annuler'])

const formVide = () => ({
  id:null,
  matricule:'',
  nom: '',
  prenom: '',
  tauxHoraire: 0,
  nombreHeure: 0
})

const localEnseignant = ref(formVide())

watch(() => props.modelValue, (nouveau) => {
  if (nouveau) {
    localEnseignant.value = { ...nouveau }
  } else {
    localEnseignant.value = formVide()
  }
}, { immediate: true })

function soumettre() {
  emit('sauvegarder', { ...localEnseignant.value })
  if (!props.isEdit) {
    localEnseignant.value = formVide()
  }
}
</script>

<template>
  <div class="form-card">

    <div class="form-header">
      <span class="form-icon">{{ isEdit ? '' : '' }}</span>
      <h3 class="form-title">
        {{ isEdit
          ? `Modifier l'Enseignant (Matricule : ${modelValue?.matricule ?? '—'})`
          : 'Ajouter un nouvel Enseignant'
        }}
      </h3>
    </div>

    <form @submit.prevent="soumettre" class="form-body">

      <div class="form-row">
        <div class="field">
          <label class="field-label">Matricule</label>
          <input type="text" v-model="localEnseignant.matricule" class="field-input" placeholder="ENS-2024-001" required />
        </div>
        <div class="field">
          <label class="field-label">Nom</label>
          <input type="text" v-model="localEnseignant.nom" class="field-input" required />
        </div>
        <div class="field">
          <label class="field-label">Prénom</label>
          <input type="text" v-model="localEnseignant.prenom" class="field-input" required />
        </div>
      </div>

      <div class="form-row">
        <div class="field">
          <label class="field-label">Taux Horaire</label>
          <input type="number" step="0.01" v-model.number="localEnseignant.tauxHoraire" class="field-input" required />
        </div>
        <div class="field">
          <label class="field-label">Nombre d'heures</label>
          <input type="number" v-model.number="localEnseignant.nombreHeure" class="field-input" required />
        </div>
      </div>

      <div class="form-actions">
        <button type="button" @click="emit('annuler')" class="btn-secondary">
          Annuler
        </button>
        <button type="submit" class="btn-primary">
          {{ isEdit ? 'Enregistrer' : 'Ajouter' }}
        </button>
      </div>

    </form>
  </div>
</template>

<style scoped>
.form-card {
  background: var(--color-surface-card);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-xl);
  padding: var(--space-6);
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.form-header {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding-bottom: var(--space-4);
  border-bottom: 1px solid var(--color-surface-border);
}

.form-icon {
  font-size: 20px;
}

.form-title {
  font-size: var(--text-xl);
  font-weight: 600;
  color: var(--color-text-primary);
}

.form-body {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.form-row {
  display: flex;
  gap: var(--space-4);
}

.field {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
  flex: 1;
}

.field-label {
  font-size: var(--text-md);
  font-weight: 600;
  color: var(--color-text-secondary);
}

.field-input {
  width: 100%;
  padding: var(--space-3) var(--space-4);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-md);
  background: var(--color-surface-subtle);
  font-size: var(--text-md);
  font-family: var(--font-mono);
  color: var(--color-text-primary);
  outline: none;
  transition: border-color 0.15s;
}

.field-input:focus {
  border-color: var(--color-surface-border-focus);
  background: var(--color-surface-card);
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: var(--space-3);
  padding-top: var(--space-4);
  border-top: 1px solid var(--color-surface-border);
}

.btn-primary {
  padding: var(--space-3) var(--space-5);
  background: var(--color-primary-600);
  color: var(--color-text-inverse);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--text-md);
  font-family: var(--font-mono);
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s;
}

.btn-primary:hover {
  background: var(--color-primary-800);
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
</style>
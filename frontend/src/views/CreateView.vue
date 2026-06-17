<script setup>
import { useRouter } from 'vue-router'
import { useEnseignantStore } from '../store/enseignants'
import EnseignantForm from '../components/enseignant/EnseignantForm.vue'

const store = useEnseignantStore()
const router = useRouter()

async function gererAjout(nouvelEnseignant) {
  const succes = await store.ajouterEnseignant(nouvelEnseignant)
  if (succes) {
    router.push('/list')
  }
}

function allerALaListe() {
  router.push('/list')
}
</script>

<template>
  <div class="create-content">

    <div class="create-header">
      <h1 class="create-title">Ajouter un Enseignant</h1>
    </div>

    <div class="create-body">
      <EnseignantForm
        :is-edit="false"
        @sauvegarder="gererAjout"
        @annuler="allerALaListe"
      />
    </div>

  </div>
</template>

<style scoped>
.create-content {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.create-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.create-title {
  font-size: var(--text-display);
  font-weight: 700;
  color: var(--color-text-primary);
}

.create-body {
  width: 100%;
  /* max-width: 720px; */
}
</style>
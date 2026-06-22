<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  titre: {
    type: String,
    default: 'Gestion des Enseignants'
  },
  enseignants: {
    type: Array,
    default: () => []
  },
  nomUtilisateur: {
    type: String,
    default: 'Administrateur'
  }
})

const emit = defineEmits(['liste-filtree', 'changer-mot-de-passe'])


const termeRecherche = ref('')

const listeFiltree = computed(() => {
  const terme = termeRecherche.value.trim().toLowerCase()
  if (!terme) return props.enseignants

  return props.enseignants.filter((e) =>
    (e.nom || '').toLowerCase().includes(terme) ||
    (e.prenom || '').toLowerCase().includes(terme) ||
    (e.matricule || '').toLowerCase().includes(terme)
  )
})

function surSaisie(e) {
  termeRecherche.value = e.target.value
  emit('liste-filtree', listeFiltree.value)
}


const profilOuvert = ref(false)
const ancienMotDePasse = ref('')
const nouveauMotDePasse = ref('')
const confirmationMotDePasse = ref('')
const erreur = ref('')
const succes = ref('')

function ouvrirProfil() {
  profilOuvert.value = true
}

function fermerProfil() {
  profilOuvert.value = false
  ancienMotDePasse.value = ''
  nouveauMotDePasse.value = ''
  confirmationMotDePasse.value = ''
  erreur.value = ''
  succes.value = ''
}

function soumettreMotDePasse() {
  erreur.value = ''
  succes.value = ''

  if (!ancienMotDePasse.value || !nouveauMotDePasse.value || !confirmationMotDePasse.value) {
    erreur.value = 'Tous les champs sont requis'
    return
  }
  if (nouveauMotDePasse.value.length < 6) {
    erreur.value = 'Le nouveau mot de passe doit contenir au moins 6 caractères'
    return
  }
  if (nouveauMotDePasse.value !== confirmationMotDePasse.value) {
    erreur.value = 'Les mots de passe ne correspondent pas'
    return
  }

  emit('changer-mot-de-passe', {
    ancienMotDePasse: ancienMotDePasse.value,
    nouveauMotDePasse: nouveauMotDePasse.value
  })
}

defineExpose({
  afficherSucces: (message) => {
    succes.value = message
    erreur.value = ''
    ancienMotDePasse.value = ''
    nouveauMotDePasse.value = ''
    confirmationMotDePasse.value = ''
  },
  afficherErreur: (message) => {
    erreur.value = message
    succes.value = ''
  }
})
</script>

<template>
  <div class="topbar">
    <div class="topbar-left">
      <h2 class="page-title">{{ titre }}</h2>
    </div>

    <div class="topbar-right">
      <div class="search-bar">
        <input
          type="text"
          class="search-input"
          placeholder="Rechercher un enseignant..."
          @input="surSaisie"
        />
      </div>

      <button type="button" class="avatar" @click="ouvrirProfil" title="Mon compte">
        {{ nomUtilisateur.charAt(0).toUpperCase() }}
      </button>
    </div>

    <!-- Panneau latéral profil -->
    <Teleport to="body">
      <div v-if="profilOuvert" class="overlay" @click="fermerProfil">
        <div class="panel" @click.stop>

          <div class="panel-header">
            <h3 class="panel-title">Mon compte</h3>
            <button type="button" class="close-btn" @click="fermerProfil">✕</button>
          </div>

          <div class="panel-body">
            <div class="profil-resume">
              <div class="avatar-large">{{ nomUtilisateur.charAt(0).toUpperCase() }}</div>
              <div class="profil-nom">{{ nomUtilisateur }}</div>
            </div>

            <div class="section-divider">Changer le mot de passe</div>

            <form @submit.prevent="soumettreMotDePasse" class="form-mdp">
              <div class="field">
                <label class="field-label">Mot de passe actuel</label>
                <input type="password" v-model="ancienMotDePasse" class="field-input" />
              </div>

              <div class="field">
                <label class="field-label">Nouveau mot de passe</label>
                <input type="password" v-model="nouveauMotDePasse" class="field-input" />
              </div>

              <div class="field">
                <label class="field-label">Confirmer le mot de passe</label>
                <input type="password" v-model="confirmationMotDePasse" class="field-input" />
              </div>

              <p v-if="erreur" class="message message--erreur">{{ erreur }}</p>
              <p v-if="succes" class="message message--succes">{{ succes }}</p>

              <button type="submit" class="btn-primary">
                Mettre à jour le mot de passe
              </button>
            </form>
          </div>
        </div>
      </div>
    </Teleport>
  </div>
</template>

<style scoped>
.topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 100%;
  padding: 0 var(--space-6);
  background: var(--color-surface-card);
  border-bottom: 1px solid var(--color-surface-border);
}

.page-title {
  font-size: var(--text-xl);
  font-weight: 600;
  color: var(--color-text-primary);
}

.topbar-right {
  display: flex;
  align-items: center;
  gap: var(--space-4);
}

/* Recherche */
.search-bar {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  background: var(--color-surface-subtle);
  border: 1px solid var(--color-surface-border);
  border-radius: var(--radius-md);
  padding: var(--space-2) var(--space-3);
  width: 240px;
  transition: border-color 0.15s, background 0.15s;
}

.search-bar:focus-within {
  border-color: var(--color-surface-border-focus);
  background: var(--color-surface-card);
}

.search-icon {
  font-size: var(--text-md);
  color: var(--color-text-tertiary);
  line-height: 1;
}

.search-input {
  flex: 1;
  border: none;
  outline: none;
  background: transparent;
  font-size: var(--text-md);
  font-family: var(--font-sans);
  color: var(--color-text-primary);
}

.search-input::placeholder {
  color: var(--color-text-tertiary);
}

/* Avatar */
.avatar {
  width: 32px;
  height: 32px;
  border-radius: var(--radius-full);
  background: var(--color-primary-600);
  color: var(--color-text-inverse);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: var(--text-md);
  font-weight: 700;
  border: none;
  cursor: pointer;
  transition: background 0.15s;
}

.avatar:hover {
  background: var(--color-primary-800);
}

/* Panneau profil */
.overlay {
  position: fixed;
  inset: 0;
  background: rgba(26, 22, 40, 0.35);
  display: flex;
  justify-content: flex-end;
  z-index: 1000;
}

.panel {
  width: 360px;
  max-width: 90vw;
  height: 100%;
  background: var(--color-surface-card);
  box-shadow: -8px 0 24px rgba(0, 0, 0, 0.12);
  display: flex;
  flex-direction: column;
  animation: glisser-entree 0.2s ease-out;
}

@keyframes glisser-entree {
  from { transform: translateX(100%); }
  to { transform: translateX(0); }
}

.panel-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: var(--space-5) var(--space-6);
  border-bottom: 1px solid var(--color-surface-border);
}

.panel-title {
  font-size: var(--text-xl);
  font-weight: 600;
  color: var(--color-text-primary);
}

.close-btn {
  background: transparent;
  border: none;
  font-size: var(--text-lg);
  color: var(--color-text-secondary);
  cursor: pointer;
  width: 28px;
  height: 28px;
  border-radius: var(--radius-md);
  transition: background 0.15s;
}

.close-btn:hover {
  background: var(--color-surface-subtle);
}

.panel-body {
  padding: var(--space-6);
  overflow-y: auto;
  flex: 1;
}

.profil-resume {
  display: flex;
  align-items: center;
  gap: var(--space-4);
  margin-bottom: var(--space-6);
}

.avatar-large {
  width: 56px;
  height: 56px;
  border-radius: var(--radius-full);
  background: var(--color-primary-600);
  color: var(--color-text-inverse);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: var(--text-display);
  font-weight: 700;
  flex-shrink: 0;
}

.profil-nom {
  font-size: var(--text-lg);
  font-weight: 600;
  color: var(--color-text-primary);
}

.section-divider {
  font-size: var(--text-sm);
  font-weight: 600;
  color: var(--color-text-tertiary);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding-bottom: var(--space-3);
  border-bottom: 1px solid var(--color-surface-border);
  margin-bottom: var(--space-4);
}

.form-mdp {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.field {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
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

.message {
  font-size: var(--text-sm);
  padding: var(--space-3);
  border-radius: var(--radius-md);
}

.message--erreur {
  color: #A32D2D;
  background: #FCEBEB;
}

.message--succes {
  color: #27500A;
  background: #EAF3DE;
}

.btn-primary {
  padding: var(--space-3) var(--space-5);
  background: var(--color-primary-600);
  color: var(--color-text-inverse);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--text-md);
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s;
}

.btn-primary:hover {
  background: var(--color-primary-800);
}
</style>
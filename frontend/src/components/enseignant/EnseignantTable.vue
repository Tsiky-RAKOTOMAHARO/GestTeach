<script setup>
import { ref } from 'vue'
import { useEnseignantStore } from '../../store/enseignants' 
import EnseignantRow from './EnseignantRow.vue'
import EnseignantForm from './EnseignantForm.vue'
import AppModal from '../common/AppModal.vue'
import DeleteConfirm from './DeleteConfirm.vue'

const store = useEnseignantStore()

// États pour la modification
const enseignantAModifier = ref(null)

// États pour la suppression
const afficherModalSuppression = ref(false)
const matriculeASupprimer = ref(null)

// --- Fonctions Modification ---
function activerEdition(enseignant) {
    enseignantAModifier.value = { ...enseignant }
}
function annulerEdition() {
    enseignantAModifier.value = null
}
async function soumettreModification(donneesModifiees) {
    await store.modifierEnseignant(donneesModifiees)
    enseignantAModifier.value = null
}

// Fonctions Suppression
function ouvrirConfirmationSuppression(matricule) {
    matriculeASupprimer.value = matricule
    afficherModalSuppression.value = true
}
function fermerModalSuppression() {
    afficherModalSuppression.value = false
    matriculeASupprimer.value = null
}
async function validerSuppression() {
    if (matriculeASupprimer.value) {
        await store.supprimerEnseignant(matriculeASupprimer.value)
        fermerModalSuppression()
    }
}
</script>

<template>
    <div>
        <table border="1">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Taux Horaire</th>
                    <th>Nombre d'heures</th>
                    <th>Total à Payer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <EnseignantRow 
                    v-for="item in store.enseignants" 
                    :key="item.matricule"
                    :enseignant="item"
                    @editer="activerEdition"
                    @supprimer="ouvrirConfirmationSuppression"
                />
            </tbody>
        </table>

        <EnseignantForm 
            v-if="enseignantAModifier" 
            v-model="enseignantAModifier"
            @sauvegarder="soumettreModification"
            @annuler="annulerEdition"
        />

        <AppModal :visible="afficherModalSuppression" @close="fermerModalSuppression">
            <DeleteConfirm 
                :itemIdentifier="matriculeASupprimer"
                @confirm="validerSuppression"
                @cancel="fermerModalSuppression"
            />
        </AppModal>
    </div>
</template>
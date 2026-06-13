<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    modelValue: {
        type: Object,
        default: null
    },
    isEdit: {
        type: Boolean,
        default: false  // ← false est plus logique comme défaut pour un formulaire
    }
})

const emit = defineEmits(['update:modelValue', 'sauvegarder', 'annuler'])

const formVide = () => ({
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
        localEnseignant.value = formVide()  // ← reset si modelValue redevient null
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
    <div class="edit-form-content">
        <h3>
            {{ isEdit 
                ? `Modifier l'Enseignant (Matricule : ${modelValue?.matricule ?? '—'})` 
                : 'Ajouter un nouvel Enseignant' 
            }}
        </h3>

        <form @submit.prevent="soumettre">
            <div>
                <label>Nom :</label>
                <input type="text" v-model="localEnseignant.nom" required />
            </div>
            <div>
                <label>Prénom :</label>
                <input type="text" v-model="localEnseignant.prenom" required />
            </div>
            <div>
                <label>Taux Horaire :</label>
                <input type="number" step="0.01" v-model.number="localEnseignant.tauxHoraire" required />
            </div>
            <div>
                <label>Nombre d'heures :</label>
                <input type="number" v-model.number="localEnseignant.nombreHeure" required />
            </div>

            <div style="margin-top: 10px;">
                <button type="submit">{{ isEdit ? 'Enregistrer' : 'Ajouter' }}</button>
                <button type="button" @click="emit('annuler')">Annuler</button>
            </div>
        </form>
    </div>
</template>
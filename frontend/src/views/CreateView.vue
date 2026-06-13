<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useEnseignantStore } from '../store/enseignants' 
import EnseignantForm from '../components/enseignant/EnseignantForm.vue'
import AppShell from '../layouts/AppShell.vue'

const store = useEnseignantStore()
const router = useRouter()

const erreur = ref(null)

async function gererAjout(nouvelEnseignant) {
    erreur.value = null
    const succes = await store.ajouterEnseignant(nouvelEnseignant)
    if (succes) {
        router.push('/list')
    } else {
        erreur.value = "Erreur lors de l'enregistrement de l'enseignant."
    }
}

function allerALaListe() {
    router.push('/list')
}
</script>

<template>
    <div style="padding: 20px;">

        <p v-if="erreur" style="color: red;">{{ erreur }}</p>

        <EnseignantForm 
            :is-edit="false" 
            @sauvegarder="gererAjout"
            @annuler="allerALaListe"
        />
    </div>
</template>
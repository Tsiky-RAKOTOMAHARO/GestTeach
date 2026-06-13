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
        <td>{{ enseignant.matricule }}</td>
        <td>{{ enseignant.nom }}</td>
        <td>{{ enseignant.prenom }}</td>
        <td>{{ enseignant.tauxHoraire }} </td>
        <td>{{ enseignant.nombreHeure }} </td>
        <td><strong>{{ enseignant.tauxHoraire * enseignant.nombreHeure }} </strong></td>
        <td>
            <button @click="emit('editer', enseignant)">Modifier</button>
            <button @click="emit('supprimer', enseignant.matricule)">Supprimer</button>
        </td>
    </tr>
</template>
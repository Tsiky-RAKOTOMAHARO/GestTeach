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
        <h3 style="color: #dc3545; margin-top: 0;">Attention !</h3>
        <p>Êtes-vous sûr de vouloir supprimer l'enseignant avec le matricule <strong>{{ itemIdentifier }}</strong> ?</p>
        <p style="font-size: 0.9em; color: #666;">Cette action est irréversible.</p>
        
        <div class="actions-buttons" style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
            <button @click="$emit('cancel')" class="btn-cancel">Annuler</button>
            <button @click="$emit('confirm')" class="btn-danger">Confirmer la suppression</button>
        </div>
    </div>
</template>

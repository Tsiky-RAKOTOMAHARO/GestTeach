<script setup>
defineProps({
    visible: {
        type: Boolean,
        required: true
    }
})
defineEmits(['close'])
</script>

<template>
    <div v-if="visible" class="modal-overlay" @click.self="$emit('close')">
        <div class="modal-card">
            <slot />
        </div>
    </div>
</template>
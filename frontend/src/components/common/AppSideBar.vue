<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth'

const authStore = useAuthStore()
const router = useRouter()

function gererDeconnexion() {
    authStore.deconnecter()
    
    router.push('/')
}
</script>

<template>

   <div class="sidebar-container">
     <RouterLink to ='/create'>
        <div class="nav-button">
            <!-- place icon-->

             <!-- bouton -->
            <button>Ajout</button>
        </div>
    </RouterLink>

    <RouterLink to ='/list'>
        <div class="nav-button">
            <!-- place icon-->

             <!-- bouton -->
            <button>Liste</button>
        </div>
    </RouterLink>
    <RouterLink to ='/stats'>
        <div class="nav-button">
            <!-- place icon-->

             <!-- bouton -->
            <button>Bilan</button>
        </div>
    </RouterLink>
    <div>
        <button @click="gererDeconnexion" class="logout-btn">
            Déconnexion
        </button>
    </div>
   </div>
</template>

<style scoped>
    .sidebar-container{
        background: var(--color-surface-card);
    }   

</style>
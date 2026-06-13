<script setup>
  import { onMounted } from 'vue';
  import { useEnseignantStore } from '../store/enseignants';
  import EnseignantTable from '../components/enseignant/EnseignantTable.vue'
  import AppShell from '@/layouts/AppShell.vue'

  // instanciation store 
  const store = useEnseignantStore()

  // chargement des données dès  le debut
  onMounted(async () =>{
    await store.chargerEnseignants()
  })
</script>

<template>
    <div class="List-content">

    <h1>Liste des Enseignants</h1>

    <EnseignantTable :enseignants="store.enseignants"/>

    <p v-if="store.message"> {{ store.message }}</p>
    
  </div> 
</template>
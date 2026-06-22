import {defineStore} from 'pinia'
import {ref} from 'vue'

export const useEnseignantStore = defineStore('enseignant', () =>{

    // le state (données)
    const enseignants = ref([])
    const message = ref('')

    async function chargerEnseignants() {
        try{
            const response = await fetch('http://localhost:8000/index.php')
            enseignants.value = await response.json()
        } catch(error){
            message.value = 'Impossible de contacter le serveur'
        }
    }

    async function ajouterEnseignant(nouvelEnseignant) {
        try{
            const response = await fetch('http://localhost:8000/index.php',
                {
                    method: 'POST',
                    headers:{
                        'Content-type': 'application/json'
                    },
                body: JSON.stringify(nouvelEnseignant)
            })

            if(response.ok){
                message.value = 'Enseignant ajouté avec succès !'

                // refraichir 
                await chargerEnseignants()
                return true
            }else{
                message.value = "Erreur lors de l'ajout de l enseignant"
                return false
            }
        }  catch(error){
                message.value = 'Impossible de contacter le serveur'
                return false
            }
    }
    
    async function modifierEnseignant(enseignantModifie) {
        try{
            const response  = await fetch('http://localhost:8000/index.php',
                 {
                    method: 'PUT',
                    headers:{
                        'Content-type': 'application/json'
                    },
                    body: JSON.stringify(enseignantModifie)
            })
        
            if(response.ok){
                message.value = 'Modification réussie !'

                await chargerEnseignants()
            }else{
                message.value = "Une erreur s'est produit lors de la modification"
            }
        }catch(error){
            message.value = 'Impossible de contacter le serveur'
        }
    }

    async function supprimerEnseignant(id){
        try{
           const response = await fetch('http://localhost:8000/index.php',
                {
                    method: 'DELETE',
                    headers:{
                        'Content-type': 'application/json'
                    },
                    body: JSON.stringify({id})
                })
            if(response.ok){
                message.value = 'Suppression réussie !'

                await chargerEnseignants()
            }else{
                message.value = "Une erreur s'est produit lors de la suppression"
            }
        }catch(error){
            message.value = 'Impossible de contacter le serveur'
        }
    }




    return{
        enseignants,
        message,
        chargerEnseignants,
        ajouterEnseignant,
        modifierEnseignant,
        supprimerEnseignant
    }
})
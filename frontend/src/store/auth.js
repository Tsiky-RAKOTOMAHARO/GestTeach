import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
    
    const estConnecte = ref(!!localStorage.getItem('isLoggedIn'))
    const messageErreur = ref('')

    async function connecter(userName, userPassword) {
        try {
            const response = await fetch('http://localhost:8000/index.php?action=login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ userName, userPassword })
            })

            const data = await response.json()

            if (response.ok) {
                estConnecte.value = true
                messageErreur.value = ''
                
                localStorage.setItem('isLoggedIn', 'true')
                
                return true 
            } else {
                estConnecte.value = false
                messageErreur.value = data.error || 'Erreur d\'authentification'
                return false
            }
        } catch (error) {
            estConnecte.value = false
            messageErreur.value = 'Impossible de joindre le serveur de sécurité'
            return false
        }
    }

    function deconnecter() {
        estConnecte.value = false
        messageErreur.value = ''
        
        localStorage.removeItem('isLoggedIn')
    }

    return {
        estConnecte,
        messageErreur,
        connecter,
        deconnecter
    }
})
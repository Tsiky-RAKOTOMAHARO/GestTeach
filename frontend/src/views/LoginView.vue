<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../store/auth'

const authStore = useAuthStore()
const router = useRouter()

const userName = ref('')
const userPassword = ref('')

async function gererConnexion() {
    const connexionReussie = await authStore.connecter(userName.value, userPassword.value)
    
    if (connexionReussie) {
        router.push('/list') 
    }
}
</script>

<template>
    <div class="login-content">
        <h2>Connexion au Panneau de Gestion</h2>

        <form @submit.prevent="gererConnexion">
            <div>
                <label>Identifiant</label>
                <input type="text" v-model="userName" placeholder="Votre identifiant" required>
            </div>
            
            <div>
                <label>Mot de passe</label>
                <input type="password" v-model="userPassword" placeholder="Votre mot de passe" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>

        <p v-if="authStore.messageErreur">
            {{ authStore.messageErreur }}
        </p>
    </div>
</template>

<style scoped>
    .login-content{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 500px;
        padding: 50px;
        margin: 25px;
        border: 2px solid black;
        border-radius: 25px;
    }
    form{
        padding: 0;
        margin: 25px;
    }
</style>